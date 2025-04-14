<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CartItems Controller
 *
 * @property \App\Model\Table\CartItemsTable $CartItems
 * @property \Authorization\Controller\Component\AuthorizationComponent $Authorization
 */
class CartItemsController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Authorization.Authorization');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->CartItems->find()
            ->contain(['Users', 'Products']);
        $query = $this->Authorization->applyScope($query);
        $cartItems = $this->paginate($query);

        $this->set(compact('cartItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Cart Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cartItem = $this->CartItems->get($id, contain: ['Users', 'Products']);
        $this->Authorization->authorize($cartItem);
        $this->set(compact('cartItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cartItem = $this->CartItems->newEmptyEntity();
        $this->Authorization->authorize($cartItem);
        if ($this->request->is('post')) {
            $cartItem = $this->CartItems->patchEntity($cartItem, $this->request->getData());
            if ($this->CartItems->save($cartItem)) {
                $this->Flash->success(__('The cart item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cart item could not be saved. Please, try again.'));
        }
        $users = $this->CartItems->Users->find('list', limit: 200)->all();
        $products = $this->CartItems->Products->find('list', limit: 200)->all();
        $this->set(compact('cartItem', 'users', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cart Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cartItem = $this->CartItems->get($id, contain: []);
        $this->Authorization->authorize($cartItem);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cartItem = $this->CartItems->patchEntity($cartItem, $this->request->getData());
            if ($this->CartItems->save($cartItem)) {
                $this->Flash->success(__('The cart item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cart item could not be saved. Please, try again.'));
        }
        $users = $this->CartItems->Users->find('list', limit: 200)->all();
        $products = $this->CartItems->Products->find('list', limit: 200)->all();
        $this->set(compact('cartItem', 'users', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cart Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cartItem = $this->CartItems->get($id);
        $this->Authorization->authorize($cartItem);
        if ($this->CartItems->delete($cartItem)) {
            $this->Flash->success(__('The cart item has been deleted.'));
        } else {
            $this->Flash->error(__('The cart item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
