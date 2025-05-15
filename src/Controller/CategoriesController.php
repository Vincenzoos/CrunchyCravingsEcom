<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Exception;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class CategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Categories->find();
        $categories = $this->paginate($query);

        $this->set(compact('categories'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function customerIndex()
    {
        $categories = $this->Categories->find()
            ->contain(['Products'])
            ->all();

        $this->set(compact('categories'));
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        if (!ctype_digit($id)) {
            $this->Flash->error(__('Category not found.'));

            return $this->redirect(['action' => 'index']);
        }
        try {
            $category = $this->Categories->get($id, [
                'contain' => ['Products'], // Include related products
            ]);

            $this->set(compact('category'));
        } catch (Exception $exception) {
            $this->Flash->error(__('Category not found.'));

            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }

        // Fetch all products for the checkboxes
        $products = $this->Categories->Products->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
        ])->toArray();

        $this->set(compact('category', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        if (!ctype_digit($id)) {
            $this->Flash->error(__('Category not found.'));

            return $this->redirect(['action' => 'index']);
        }
        try {
            $category = $this->Categories->get($id, ['contain' => ['Products']]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $category = $this->Categories->patchEntity($category, $this->request->getData());
                if ($this->Categories->save($category)) {
                    $this->Flash->success(__('The category has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }

            // Fetch all products for the checkboxes
            $allProducts = $this->Categories->Products->find('list', [
                'keyField' => 'id',
                'valueField' => 'name',
            ])->toArray();

            // Get associated product IDs
            $associatedProductIds = array_map(function ($product) {
                return $product->id;
            }, $category->products);

            // Pass variables to the view
            $this->set(compact('category', 'allProducts', 'associatedProductIds'));
        } catch (Exception $exception) {
            $this->Flash->error(__('Category not found.'));

            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        // Block access to action using GET method
        // Block user to manually access the action (e.g. categories/delete/1 in URL)
        if ($this->request->is('get')) {
            $this->Flash->error(__('Invalid access to delete action'));

            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // Override the beforeFilter method to allow unauthenticated access to these pages
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['customerIndex']);
    }
}
