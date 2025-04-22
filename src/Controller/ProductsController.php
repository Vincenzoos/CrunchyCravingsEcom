<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Fetch all categories using the association (get list of categories objects)
        $categories = $this->Products->Categories->find('all')->all();

        // Get the no_products number of products
        $no_products = $this->Products->find()->count();

        // Fetch products
        $query = $this->Products->find();

        // get input from filter forms for filter functionalities
        $product_name = $this->request->getQuery('product_name');
        $stock_quantity = $this->request->getQuery('stock_quantity');
        $min_price = $this->request->getQuery('min_price');
        $max_price = $this->request->getQuery('max_price');
        // get list of key-value pairs (key: category_name - value: category_name)
        $categoriesList = $this->Products->Categories->find('list')->all();
        // retrieve list of categories_id selected in dropdown of filter form
        $selectedCategories = $this->request->getQuery('categories._ids');

        // Build onto the products query to complete the filter
        //  Filter products by name
        if (!empty($product_name)) {
            $query->where(['Products.name LIKE' => '%' . $product_name . '%']);
        }

        // Filter products by stock_quantity (less than or equals)
        if (is_numeric($stock_quantity)) {
            $query->where(['Products.quantity <=' => $stock_quantity]);
        }

        // Filter products by price (from min to max inclusive)
        if (is_numeric($min_price)) {
            $query->where(['Products.price >=' => $min_price]);
        }

        if (is_numeric($max_price)) {
            $query->where(['Products.price <=' => $max_price]);
        }

        // Filter products by categories (exact match)
        if (!empty($selectedCategories) && $selectedCategories !== ['']) {
            $query->matching('Categories')
                ->groupBy(['Products.id'])
                ->where(['Categories.id IN' => $selectedCategories]);
        }

        $products = $this->paginate($query);

        // Pass variables to the view
        $this->set(compact('products', 'categories', 'categoriesList', 'no_products'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function customerIndex()
    {
        // Fetch all categories using the association (get list of categories objects)
        $categories = $this->Products->Categories->find('all')->all();

        // Get the no_products number of products
        $no_products = $this->Products->find()->count();

        // Fetch products
        $query = $this->Products->find();

        // Filter products by category if category_id is provided
        if ($this->request->getQuery('category_id')) {
            $categoryId = $this->request->getQuery('category_id');

            // Use the `matching()` method to filter products by category
            $query = $query->matching('Categories', function ($q) use ($categoryId) {
                return $q->where(['Categories.id' => $categoryId]);
            });
        }

        // get input from filter forms for filter functionalities
        $product_name = $this->request->getQuery('product_name');
        $stock_quantity = $this->request->getQuery('stock_quantity');
        $min_price = $this->request->getQuery('min_price');
        $max_price = $this->request->getQuery('max_price');
        // get list of key-value pairs (key: category_name - value: category_name)
        $categoriesList = $this->Products->Categories->find('list')->all();
        // retrieve list of categories_id selected in dropdown of filter form
        $selectedCategories = $this->request->getQuery('categories._ids');

        // Build onto the products query to complete the filter
        //  Filter products by name
        if (!empty($product_name)) {
            $query->where(['Products.name LIKE' => '%' . $product_name . '%']);
        }

        // Filter products by stock_quantity (less than or equals)
        if (is_numeric($stock_quantity)) {
            $query->where(['Products.quantity <=' => $stock_quantity]);
        }

        // Filter products by price (from min to max inclusive)
        if (is_numeric($min_price)) {
            $query->where(['Products.price >=' => $min_price]);
        }

        if (is_numeric($max_price)) {
            $query->where(['Products.price <=' => $max_price]);
        }

        // Filter products by categories (exact match)
        if (!empty($selectedCategories) && $selectedCategories !== ['']) {
            $query->matching('Categories')
                ->groupBy(['Products.id'])
                ->where(['Categories.id IN' => $selectedCategories]);
        }

        $sort = $this->request->getQuery('sort');

        // Default sorting
        $order = ['Products.id' => 'DESC'];

        // Adjust sorting based on the 'sort' parameter
        if ($sort === 'price_asc') {
            $order = ['Products.price' => 'ASC'];
        } elseif ($sort === 'price_desc') {
            $order = ['Products.price' => 'DESC'];
        } elseif ($sort === 'newest') {
            $order = ['Products.id' => 'ASC'];
        }

        // Apply sorting to the query
        $query->order($order);

        // Fetch products with the specified order
        $products = $this->Products->find('all', [
            'order' => $order,
            'contain' => ['Categories'], // Include related data if needed
        ]);

        $categoriesList = $this->Products->Categories->find('list');

        // Apply pagination
        $products = $this->paginate($query);

        // Pass variables to the view
        $this->set(compact('products', 'categories', 'categoriesList', 'no_products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        // Fetch the current product with associated categories
        $product = $this->Products->get($id, [
            'contain' => ['Categories'], // Include associated categories
        ]);

        // Fetch all categories
        $allCategories = $this->Products->Categories->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
        ])->toArray();

        // Get associated category IDs
        $associatedCategoryIds = array_map(function ($category) {
            return $category->id;
        }, $product->categories);

        // Pass variables to the view
        $this->set(compact('product','allCategories', 'associatedCategoryIds'));
    }

    /**
     * Customer view method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function customerView(?string $id = null)
    {
        // Fetch the current product with associated categories
        $product = $this->Products->get($id, [
            'contain' => ['Categories'], // Include associated categories
        ]);

        // Fetch similar products (excluding the current product)
        $similarProducts = $this->Products->find()
            ->where(['id !=' => $id]) // Exclude the current product
            ->limit(2) // Limit to 2 products
            ->all();

        // Fetch all categories
        $allCategories = $this->Products->Categories->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
        ])->toArray();

        // Get associated category IDs
        $associatedCategoryIds = array_map(function ($category) {
            return $category->id;
        }, $product->categories);

        // Pass variables to the view
        $this->set(compact('product', 'similarProducts','allCategories', 'associatedCategoryIds'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please try again.'));
        }

        // Fetch all categories
        $allCategories = $this->Products->Categories->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
        ])->toArray();

        $this->set(compact('product', 'allCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $product = $this->Products->get($id, ['contain' => ['Categories']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please try again.'));
        }

        // Fetch all categories
        $allCategories = $this->Products->Categories->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
        ])->toArray();

        // Get associated category IDs
        $associatedCategoryIds = array_map(function ($category) {
            return $category->id;
        }, $product->categories);

        $this->set(compact('product', 'allCategories', 'associatedCategoryIds'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        // Handle null products image
        if (empty($product->image) || $product->image == null) {
            $product->image = '/files/Products/image/default-product.jpg';
        }
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // Override the beforeFilter method to allow unauthenticated access to these pages
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['customerIndex', 'customerView']);
    }
}
