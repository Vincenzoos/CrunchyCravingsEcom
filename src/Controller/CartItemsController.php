<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\Log\Log;
use Cake\Mailer\Mailer;
use Exception;
use stdClass;

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
        // Check if the user is logged in
        $identity = $this->Authentication->getIdentity();
        $userId = $identity ? $identity->get('id') : null;

        if ($userId) {
            // Fetch cart items for the logged-in user
            $query = $this->CartItems->find('all')
                ->contain(['Products'])
                ->where(['user_id' => $userId]);
            $cartItems = $this->paginate($query);

            // Calculate total price
            $total_price = 0;
            foreach ($cartItems as $item) {
                $total_price += $item->line_price;
            }

            Log::write('debug', json_encode($cartItems));

            $this->set(compact('cartItems', 'total_price'));
        } else {
            // Fetch cart items from session for unauthenticated users
            $session = $this->request->getSession();
            $cart = $session->read('Cart') ?? [];

            // Fetch product details for each item in the session cart
            $cartItems = [];
            $total_price = 0;

            foreach ($cart as $productId => $item) {
                $product = $this->CartItems->Products->find()
                    ->where(['id' => $productId])
                    ->first();

                if ($product) {
                    // Combine product details with session cart data
                    $cartItem = new stdClass();
                    $cartItem->id = $productId;
                    $cartItem->user_id = null; // Unauthenticated users don't have a user ID
                    $cartItem->product_id = $productId;
                    $cartItem->quantity = $item['quantity'];
                    $cartItem->created = null; // No created timestamp for session-based cart
                    $cartItem->modified = null; // No modified timestamp for session-based cart
                    $cartItem->line_price = ($product->price ?? 0) * $item['quantity']; // Default to 0 if price is null
                    $cartItem->product = $product;

                    $cartItems[] = $cartItem;

                    // Add to total price
                    $total_price += $cartItem->line_price;
                }
            }

            Log::write('debug', json_encode($cartItems));

            $this->set(compact('cartItems', 'total_price'));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Cart Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
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
    public function edit(?string $id = null)
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
            // Get the current user identity
            $identity = $this->Authentication->getIdentity();
            $userId = $identity ? $identity->get('id') : null;

            // Get the new quantity from the request
            $quantity = $this->request->getData('quantity');

            // Ensure the quantity is valid
            if ($quantity < 1) {
                $this->Flash->error(__('Quantity must be at least 1.'));

                return $this->redirect($this->referer());
            }

            if ($userId) {
                // Handle logged-in users (database-based cart)
                $cartItem = $this->CartItems->get($id);

                if (!$cartItem) {
                    $this->Flash->error(__('Cart item not found.'));

                    return $this->redirect($this->referer());
                }

                // Update the quantity and save
                $cartItem->quantity = $quantity;
//                $cartItem->line_price = $cartItem->product->price * $quantity;

                if ($this->CartItems->save($cartItem)) {
                    $this->Flash->success(__('Cart item quantity updated successfully.'));
                } else {
                    $this->Flash->error(__('Unable to update cart item quantity. Please try again.'));
                }
            } else {
                // Handle unauthenticated users (session-based cart)
                $session = $this->request->getSession();
                $cart = $session->read('Cart') ?? [];

                if (!isset($cart[$id])) {
                    $this->Flash->error(__('Cart item not found.'));

                    return $this->redirect($this->referer());
                }

                // Fetch the product details dynamically
                $product = $this->CartItems->Products->find()
                    ->where(['CartItems.id' => $id])
                    ->first();

                if (!$product) {
                    $this->Flash->error(__('Product not found.'));

                    return $this->redirect($this->referer());
                }

                // Update the quantity and line price in the session cart
                $cart[$id]['quantity'] = $quantity;
                $cart[$id]['price'] = $product->price; // Ensure price is set
                $cart[$id]['line_price'] = $product->price * $quantity; // Calculate line price

                // Save the updated cart back to the session
                $session->write('Cart', $cart);

                $this->Flash->success(__('Cart item quantity updated successfully.'));
            }
        }

        // Redirect back to the referring page
        return $this->redirect($this->referer());
    }

    /**
     * Update Quantity Method
     *
     * @param string|null $id Cart Item id.
     * @param int|null $quantity Cart Item new quantity.
     */
    public function updateQuantity(?string $id = null, ?int $quantity = null)
    {
        // Ensure the ID and quantity are provided
        if ($id === null || $quantity === null) {
            $this->Flash->error(__('Invalid request. Please try again.'));

            return $this->redirect($this->referer());
        }

        // Ensure the quantity is a positive integer
        if ($quantity < 1) {
            $this->Flash->error(__('Quantity must be at least 1.'));

            return $this->redirect($this->referer());
        }

        // Check if the user is logged in
        $identity = $this->Authentication->getIdentity();
        $userId = $identity ? $identity->get('id') : null;

        if ($userId) {
            // Handle logged-in users (database-based cart)
            $cartItem = $this->CartItems->get($id);

            if (!$cartItem) {
                $this->Flash->error(__('Cart item not found.'));

                return $this->redirect($this->referer());
            }

            // Update the quantity (dont need update line_price since it is virtual field, used for display only)
            $cartItem->quantity = $quantity;

            // Save the updated cart item
            if ($this->CartItems->save($cartItem)) {
                $this->Flash->success(__('Cart item quantity updated successfully.'));
            } else {
                $this->Flash->error(__('Unable to update cart item quantity. Please try again.'));
            }
        } else {
            // Handle unauthenticated users (session-based cart)
            $session = $this->request->getSession();
            $cart = $session->read('Cart') ?? [];

            if (!isset($cart[$id])) {
                $this->Flash->error(__('Cart item not found.'));

                return $this->redirect($this->referer());
            }

            // Fetch the product details dynamically
            $product = $this->CartItems->Products->find()
                ->where(['id' => $id])
                ->first();

            if (!$product) {
                $this->Flash->error(__('Product not found.'));

                return $this->redirect($this->referer());
            }

            // Update the quantity and line price in the session cart
            $cart[$id]['quantity'] = $quantity;
            $cart[$id]['line_price'] = $product->price * $quantity;

            // Save the updated cart back to the session
            $session->write('Cart', $cart);

            $this->Flash->success(__('Cart item quantity updated successfully.'));
        }

        // Redirect back to the referring page
        return $this->redirect($this->referer());
    }

    /**
     * Delete method
     *
     * @param string|null $id Cart Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $identity = $this->Authentication->getIdentity();
        $userId = $identity ? $identity->get('id') : null;

        if ($userId) {
            // Delete from database for logged-in users
            $cartItem = $this->CartItems->get($id);

            if ($cartItem && $this->CartItems->delete($cartItem)) {
                $this->Flash->success(__('The cart item has been deleted.'));
            } else {
                $this->Flash->error(__('Unable to delete the cart item. Please, try again.'));
            }
        } else {
            // Delete from session for unauthenticated users
            $session = $this->request->getSession();
            $cart = $session->read('Cart') ?? [];

            if (isset($cart[$id])) {
                unset($cart[$id]);
                $session->write('Cart', $cart);
                $this->Flash->success(__('The cart item has been deleted.'));
            } else {
                $this->Flash->error(__('Cart item not found.'));
            }
        }

        return $this->redirect(['action' => 'customerView']);
    }

    /**
     * Add a product to the cart
     *
     * @param string|null $productId Product ID.
     * @return \Cake\Http\Response|null Redirects to customerView.
     */
    public function customerAdd(?string $productId = null)
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

        // Check if the product is in stock
        if ($product->quantity <= 0) {
            $this->Flash->error(__('"' . $product->name . '" is out of stock.'));

            return $this->redirect($this->referer());
        }

        // Get the ID of current user
        $identity = $this->Authentication->getIdentity();
        $userId = $identity ? $identity->get('id') : null;

        $selected_quantity = $this->request->getData('quantity') + 1 ?? 1;

        // Check if the user is logged in
        if ($userId) {
            // Check if the product is already in the current user's cart
            // If it is, update the quantity and line_price; otherwise, create a new cart item.
            $existingItem = $this->CartItems->find('all')
            ->where([
                'user_id' => $userId,
                'product_id' => $productId,
            ])
            ->first();

//            $selected_quantity = $this->request->getData('quantity') + 1 ?? 1;

            // If item already existed in cart, only increase quantity of that item in cart
            if (!is_null($existingItem)) {
                // Validate the selected quantity
                if ($selected_quantity <= 0) {
                    $this->Flash->error(__('Please select at least one item to add to the cart.'));

                    return $this->redirect($this->referer());
                }

                // Update the quantity and recalculate the line price
                $existingItem->quantity += $selected_quantity;
//                $existingItem->line_price = $existingItem->quantity * $product->price;

                // Check stock availability
                if ($existingItem->quantity > $product->quantity) {
                    $this->Flash->error(__('"' . $product->name . '" does not have enough stock. Please try with a smaller quantity.'));

                    return $this->redirect($this->referer());
                }

                if ($this->CartItems->save($existingItem)) {
                    $this->Flash->success(__('Cart updated with ' . $selected_quantity . ' unit(s) of "' . $product->name . '".'));
                } else {
                    $this->Flash->error(__('Unable to update your cart. Please try again.'));
                }
            // If item not exist in cart, add it to cart
            } else {
                $cartItem = $this->CartItems->newEmptyEntity();
                $cartItem->user_id = $userId;
                $cartItem->product_id = $productId;
                $cartItem->quantity = $selected_quantity;

                if ($this->CartItems->save($cartItem)) {
                    $this->Flash->success(__('"' . $product->name . '" has been added to your cart.'));
                } else {
                    $this->Flash->error(__('"' . $product->name . '" could not be added. Please, try again.'));
                }
            }
        } else {
            // Handle unauthenticated users (session-based cart)
            $session = $this->request->getSession();
            $cart = $session->read('Cart') ?? [];

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $selected_quantity;
            } else {
                $cart[$productId] = [
                    'product_id' => $productId,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $selected_quantity,
                ];
            }

            // Save to session
            $session->write('Cart', $cart);
            $this->Flash->success(__('"' . $product->name . '" has been added to your cart.'));
        }

        // Redirect back to the referring page (or to a dedicated cart view)
        return $this->redirect($this->referer());
    }

    public function checkout()
    {
        // Check if the user is logged in
        $identity = $this->Authentication->getIdentity();
        $userId = $identity ? $identity->get('id') : null;

        $cartItems = [];
        $total = 0;

        if ($userId) {
            // Retrieve cart items for the logged-in user including associated product info
            $cartItems = $this->CartItems->find('all')
                ->contain(['Products'])
                ->where(['CartItems.user_id' => $userId])
                ->toArray();

            if (empty($cartItems)) {
                $this->Flash->error(__('Your cart is empty.'));

                return $this->redirect(['action' => 'customerView']);
            }

            // Calculate the total amount
            foreach ($cartItems as $item) {
                $item->line_price = $item->line_price ?? 0; // Ensure line_price is set
                $total += $item->line_price;
            }
        } else {
            // Retrieve cart items from the session for unauthenticated users
            $session = $this->request->getSession();
            $cart = $session->read('Cart') ?? [];

            if (empty($cart)) {
                $this->Flash->error(__('Your cart is empty.'));

                return $this->redirect(['action' => 'customerView']);
            }

            // Fetch product details for each item in the session cart
            foreach ($cart as $productId => $item) {
                $product = $this->CartItems->Products->find()
                    ->where(['id' => $productId])
                    ->first();

                if ($product) {
                    $cartItems[] = [
                        'product' => $product,
                        'quantity' => $item['quantity'],
                        'line_price' => $item['line_price'] ?? $product->price * $item['quantity'], // Default to calculated value
                    ];
                    $total += $item['line_price'] ?? $product->price * $item['quantity'];
                }
            }
        }

        try {
            Log::write('debug', json_encode($cartItems));

            // Determine the recipient email
            $recipient = $userId ? $identity->get('email') : 'guest@example.com'; // Replace with a default email for guests

            $mailer = new Mailer('default');
            $mailer
                ->setEmailFormat('both') // Sends both HTML and text versions
                ->setTo($recipient)
                ->setSubject('Your Order Confirmation')
                ->viewBuilder()
                ->setTemplate('customer_checkout');

            // Pass required variables to your email template
            $mailer->setViewVars([
                'email' => $recipient,
                'cartItems' => $cartItems,
                'total' => $total,
            ]);

            if (!$mailer->deliver()) {
                $this->Flash->error(__('We encountered an issue sending your order confirmation email. Please try again.'));

                return $this->redirect(['action' => 'customerView']);
            }

            $this->Flash->success(__('Your order has been processed and a confirmation email has been sent.'));

            // Clear the cart after checkout
            if ($userId) {
                $this->CartItems->deleteAll(['user_id' => $userId]);
            } else {
                $session->delete('Cart');
            }
        } catch (Exception $e) {
            $this->Flash->error(__('Error sending email to ' . $recipient . '. The provided email address may not exist, please check the email address and try again.'));

            return $this->redirect(['action' => 'customerView']);
        }

        return $this->redirect(['controller' => 'Products', 'action' => 'customerIndex']);
    }

    /**
     * Clear the cart
     *
     * @return \Cake\Http\Response|null Redirects to customerView.
     */
    public function clearCart()
    {
        $identity = $this->Authentication->getIdentity();
        $userId = $identity ? $identity->get('id') : null;

        if ($userId) {
            // Clear the cart for logged-in users
            $this->CartItems->deleteAll(['user_id' => $userId]);
        } else {
            // Clear the session cart for unauthenticated users
            $session = $this->request->getSession();
            $session->delete('Cart');
        }

        $this->Flash->success(__('Your cart has been cleared.'));

        return $this->redirect(['action' => 'customerView']);
    }

    // Override the beforeFilter method to allow unauthenticated access to these pages
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['customerView', 'customerAdd', 'updateQuantity', 'delete', 'checkout', 'clearCart', 'update']);
    }
}
