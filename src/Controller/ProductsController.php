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
        $this->request->allowMethod(['get']);

        // // Fetch query parameters
        // $categories = $this->request->getQuery('categories', []);
        // $minPrice = $this->request->getQuery('min_price', 0);
        // $maxPrice = $this->request->getQuery('max_price', 1000);

        // // Debug the received parameters
        // // debug($categories);
        // // debug($minPrice);
        // // debug($maxPrice);

        // // Build the query
        // $query = $this->Products->find();

        // if (!empty($categories)) {
        //     $query->where(['category_id IN' => $categories]);
        // }

        // $query->where([
        //     'price >=' => $minPrice,
        //     'price <=' => $maxPrice
        // ]);

        // // If it's an AJAX request, return only the filtered products as HTML
        // if ($this->request->is('ajax')) {
        //     $products = $query->all();
        //     $this->set(compact('products'));
        //     // $this->viewBuilder()->setLayout(""); // Disable layout for AJAX
        //     return $this->render('ajax_products'); // Render a partial view for AJAX
        // }

        // Fetch all categories using the association
        $categories = $this->Products->Categories->find('all')->all();

        // Fetch products
        $query = $this->Products->find();
        $products = $this->paginate($query);

        // Get the total number of products
        $total = $this->Products->find()->count();

        // Pass variables to the view
        $this->set(compact('categories', 'products', 'total'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // Fetch all categories using the association
        $categories = $this->Products->Categories->find('all')->all();

        // Fetch the current product
        $product = $this->Products->get($id, [
            'contain' => ['Categories'], // Include related categories if needed
        ]);
        
        // Fetch similar products (excluding the current product)
        $similarProducts = $this->Products->find()
            ->where(['id !=' => $id]) // Exclude the current product
            ->limit(2) // Limit to 2 products
            ->all();

        // Pass variables to the view
        $this->set(compact('categories', 'product', 'similarProducts'));
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
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Products->Categories->find('list', limit: 200)->all();
        $this->set(compact('product', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, contain: ['Categories']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Products->Categories->find('list', limit: 200)->all();
        $this->set(compact('product', 'categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
