<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;
use Exception;

/**
 * CartItems Controller
 *
 * @property \App\Model\Table\CartItemsTable $CartItems
 */
class CartItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->CartItems->find()->contain(['Users', 'Products']);
        $cartItems = $this->paginate($query);

        $this->set(compact('cartItems'));
    }

    /**
     * Allow specific user to inspect their cart
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function customerView()
    {
        // Get the ID of current user
        $identity = $this->Authentication->getIdentity();
        $userId = $identity ? $identity->get('id') : null;
        $query = $this->CartItems->find('all')
            ->contain(['Products'])
            ->where([
                'user_id' => $userId,
            ]);
        $cartItems = $this->paginate($query);
        // Calculate total price
        $total_price = 0;
        foreach ($cartItems as $item) {
            $total_price += $item->line_price;
        }

        $this->set(compact('cartItems', 'total_price'));
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
     * Update method
     *
     * @param string|null $id Cart Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function update(?string $id = null)
    {
        if ($this->request->is('post')) {
            // Fetch the cart item by ID
            $cartItem = $this->CartItems->get($id, ['contain' => ['Products']]);

            if ($cartItem) {
                // Update quantity
                $quantity = $this->request->getData('quantity');
                if ($quantity > 0) {
                    $cartItem->quantity = $quantity;

                    if ($this->CartItems->save($cartItem)) {
                        $this->Flash->success(__('The cart item has been updated.'));
                    } else {
                        $this->Flash->error(__('Failed to update the cart item.'));
                    }
                } else {
                    $this->Flash->error(__('Invalid quantity.'));
                }
            } else {
                $this->Flash->error(__('Cart item not found.'));
            }
        }
        // Redirect back to the cart view
        return $this->redirect(['action' => 'customerView']);
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
        // $this->Authorization->authorize($cartItem);
        if ($this->CartItems->delete($cartItem)) {
            $this->Flash->success(__('The cart item has been deleted.'));
        } else {
            $this->Flash->error(__('The cart item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'customerView']);
    }

    public function customerAdd($productId = null)
    {
        // Only allow POST and GET
        $this->request->allowMethod(['get', 'post']);

        // Retrieve product information from Products table
        try {
            $product = $this->CartItems->Products->get($productId);
        } catch (Exception $ex) {
            $this->Flash->error(__('Product not found.'));

            return $this->redirect($this->referer());
        }
        // Get the ID of current user
        $identity = $this->Authentication->getIdentity();
        $userId = $identity ? $identity->get('id') : null;

        // Check if the product is in stock
        if ($product->quantity <= 0) {
            $this->Flash->error(__('"' . $product->name . '" is out of stock.'));

            return $this->redirect($this->referer());
        }

        // Check if the product is already in the current user's cart
        // If it is, update the quantity and line_price; otherwise, create a new cart item.
        $existingItem = $this->CartItems->find('all')
            ->where([
                'user_id' => $userId,
                'product_id' => $productId,
            ])
            ->first();

        // If item already existed in cart, only increase quantity of that item in cart
        if (!is_null($existingItem)) {
            // Increase quantity and re-calculated line_price
            $existingItem->quantity += 1;
            if ($this->CartItems->save($existingItem)) {
                $this->Flash->success(__('Cart updated with one more unit of "' . $product->name . '".'));
            } else {
                $this->Flash->error(__('Unable to update your cart. Please, try again.'));
            }
        // If item not exist in cart, add it to cart
        } else {
            $cartItem = $this->CartItems->newEmptyEntity();
            $cartItem->user_id = $userId;
            $cartItem->product_id = $productId;
            $cartItem->quantity = 1;

            if ($this->CartItems->save($cartItem)) {
                $this->Flash->success(__('"' . $product->name . '" has been added to your cart.'));
            } else {
                $this->Flash->error(__('"' . $product->name . '" could not be added. Please, try again.'));
            }
        }

        // Redirect back to the referring page (or to a dedicated cart view)
        return $this->redirect($this->referer());
    }

    public function checkout()
    {
        // Ensure the user is logged in
        $user = $this->Authentication->getIdentity();

        $userId = $user->get('id');
        // Retrieve cart items for the current user including associated product info
        $cartItems = $this->CartItems->find('all')
            ->contain(['Products'])
            ->where(['CartItems.user_id' => $userId])
            ->toArray();

        if (empty($cartItems)) {
            $this->Flash->error(__('Your cart is empty.'));

            return $this->redirect(['action' => 'customerView']);
        }

        // Calculate the total amount
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->line_price;
        }

        try {
            $mailer = new Mailer('default');
            $mailer
                ->setEmailFormat('both') // sends both html and text versions
                ->setTo($user->get('email'))
                ->setSubject('Your Order Confirmation')
                ->viewBuilder()
                ->setTemplate('customer_checkout');

            // Pass required variables to your email template
            $mailer->setViewVars([
//                Could add first_name and last_name field to Users entity for messages and email
//                'first_name' => $user->get('first_name'),
//                'last_name'  => $user->get('last_name'),
                'email'      => $user->get('email'),
                'cartItems'  => $cartItems,
                'total'      => $total,
            ]);

            if (!$mailer->deliver()) {
                $this->Flash->error(__('We encountered an issue sending your order confirmation email. Please try again.'));

                return $this->redirect(['action' => 'customerView']);
            }

            $this->Flash->success(__('Your order has been processed and a confirmation email has been sent.'));

            // Optionally clear the cart here if the order is complete
             $this->CartItems->deleteAll(['user_id' => $userId]);
        } catch (Exception $e) {
            $this->Flash->error(__('Error sending email: '));

            return $this->redirect(['action' => 'customerView']);
        }

        return $this->redirect(['controller' => 'Products', 'action' => 'customerIndex']);
    }
}
