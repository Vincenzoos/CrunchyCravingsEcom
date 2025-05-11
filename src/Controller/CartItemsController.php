<?php
declare(strict_types=1);

namespace App\Controller;

// Used for cpanel testing
use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\Mailer\Mailer;
use Exception;
use stdClass;

/**
 * CartItems Controller
 *
 * @property \App\Model\Table\CartItemsTable $CartItems
 * @property \App\Model\Table\OrdersTable $Orders
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
    // public function updateQuantity(?string $id = null, ?int $quantity = null)
    // {
    //     // Ensure the ID and quantity are provided
    //     if ($id === null || $quantity === null) {
    //         $this->Flash->error(__('Invalid request. Please try again.'));

    //         return $this->redirect($this->referer());
    //     }

    //     // Ensure the quantity is a positive integer
    //     if ($quantity < 1) {
    //         $this->Flash->error(__('Quantity must be at least 1.'));

    //         return $this->redirect($this->referer());
    //     }

    //     // Check if the user is logged in
    //     $identity = $this->Authentication->getIdentity();
    //     $userId = $identity ? $identity->get('id') : null;

    //     if ($userId) {
    //         // Handle logged-in users (database-based cart)
    //         $cartItem = $this->CartItems->get($id);

    //         if (!$cartItem) {
    //             $this->Flash->error(__('Cart item not found.'));

    //             return $this->redirect($this->referer());
    //         }

    //         // Update the quantity (dont need update line_price since it is virtual field, used for display only)
    //         $cartItem->quantity = $quantity;

    //         // Save the updated cart item
    //         if ($this->CartItems->save($cartItem)) {
    //             $this->Flash->success(__('Cart item quantity updated successfully.'));
    //         } else {
    //             $this->Flash->error(__('Unable to update cart item quantity. Please try again.'));
    //         }
    //     } else {
    //         // Handle unauthenticated users (session-based cart)
    //         $session = $this->request->getSession();
    //         $cart = $session->read('Cart') ?? [];

    //         if (!isset($cart[$id])) {
    //             $this->Flash->error(__('Cart item not found.'));

    //             return $this->redirect($this->referer());
    //         }

    //         // Fetch the product details dynamically
    //         $product = $this->CartItems->Products->find()
    //             ->where(['id' => $id])
    //             ->first();

    //         if (!$product) {
    //             $this->Flash->error(__('Product not found.'));

    //             return $this->redirect($this->referer());
    //         }

    //         // Update the quantity and line price in the session cart
    //         $cart[$id]['quantity'] = $quantity;
    //         $cart[$id]['line_price'] = $product->price * $quantity;

    //         // Save the updated cart back to the session
    //         $session->write('Cart', $cart);

    //         $this->Flash->success(__('Cart item quantity updated successfully.'));
    //     }

    //     // Redirect back to the referring page
    //     return $this->redirect($this->referer());
    // }

    public function updateQuantityAjax()
    {
        $this->request->allowMethod(['post', 'ajax']); // Allow only POST and AJAX requests


        $cartItemId = $this->request->getData('cart_item_id');
        $newQuantity = $this->request->getData('quantity');

        // Ensure the quantity is valid
        if ($newQuantity < 1) {
            $response = ['success' => false, 'message' => 'Quantity must be at least 1.'];
            $this->set('response', $response);
            $this->viewBuilder()->setOption('serialize', ['response']);

            return;
        }
        // TODO: Add restriction, not allow user to add more than number of stock available
//        elseif ($newQuantity > $productEntity->quantity) {
//            $response = ['success' => false, 'message' => 'Product is out of stock.'];
//            $this->set('response', $response); // Add this line so the response is set for serialization
//            $this->viewBuilder()->setOption('serialize', ['response']);
//
//            return;
//        }

        // Check if the user is logged in
        $identity = $this->Authentication->getIdentity();
        $userId = $identity ? $identity->get('id') : null;

        if ($userId) {
            // Handle logged-in users (database-based cart)
            $cartItem = $this->CartItems->get($cartItemId, ['contain' => ['Products']]);
            if ($cartItem) {
                $productEntity = $this->CartItems->Products->get($cartItem->product_id);
                // Update product stock dynamically
                $oldQuantity = $cartItem->quantity;
                // Number of new item added/deleted
                $delta = $newQuantity - $oldQuantity;
                // If it is adding, decrease the stock quality accordingly
                if ($delta > 0) {
                    // If the additional quantity more than actual number of stock available, raise error
                    if ($delta > $productEntity->quantity) {
                        $response = [
                            'success' => false,
                            'message' => 'Not enough stock available for ' . $productEntity->name,
                        ];
                        $this->set(compact('response'));
                        $this->viewBuilder()->setOption('serialize', ['response']);

                        return;
                    }
                    // If the additional quantity is less than or equal the current number of stock
                    $productEntity->quantity -= $delta;
                    // If it is deleting, increase stock quantity accordingly
                } elseif ($delta < 0) {
                    $productEntity->quantity += abs($delta);
                }
                // Update cart item based on new quantity
                $cartItem->quantity = $newQuantity;
                $cartItem->line_price = $cartItem->quantity * $cartItem->product->price;

                // Save the cartItem
                if ($this->CartItems->save($cartItem)) {
                    $response = [
                        'success' => true,
                        'line_price' => $cartItem->line_price,
                        'total_price' => $this->CartItems->calculateTotalPrice($userId),
                    ];
                } else {
                    $response = ['success' => false, 'message' => 'Failed to update cart item.'];
                }

                // Use a transaction here to ensure atomicity
                $connection = $this->CartItems->getConnection();
                $connection->begin();
                $cartSaved = $this->CartItems->save($cartItem);
                $productSaved = $this->CartItems->Products->save($productEntity);

                if ($cartSaved && $productSaved) {
                    $connection->commit();
                    $response = [
                        'success' => true,
                        'line_price' => $cartItem->line_price,
                        'total_price' => $this->CartItems->calculateTotalPrice($userId),
                    ];
                } else {
                    $connection->rollback();
                    $response = ['success' => false, 'message' => 'Failed to update cart or product stock.'];
                }
            } else {
                $response = ['success' => false, 'message' => 'Cart item not found.'];
            }
        } else {
            // Handle unauthenticated users (session-based cart)
            $session = $this->request->getSession();
            $cart = $session->read('Cart') ?? [];

            if (!isset($cart[$cartItemId])) {
                $response = ['success' => false, 'message' => 'Cart item not found.'];
            } else {
                // It is recommended to fetch the actual product entity to update stock even for session-managed carts.
                $productEntity = $this->CartItems->Products->get($cartItemId);
                if (!$productEntity) {
                    $response = ['success' => false, 'message' => 'Product not found.'];
                } else {
                    // Update product stock dynamically
                    $oldQuantity = $cart[$cartItemId]['quantity'];
                    // Number of new item added/deleted
                    $delta = $newQuantity - $oldQuantity;
                    // If it is adding, decrease the stock quality accordingly
                    if ($delta > 0) {
                        // If the additional quantity more than actual number of stock available, raise error
                        if ($delta > $productEntity->quantity) {
                            $response = [
                                'success' => false,
                                'message' => 'Not enough stock available for ' . $productEntity->name,
                            ];
                            $this->set(compact('response'));
                            $this->viewBuilder()->setOption('serialize', ['response']);

                            return;
                        }
                        // If the additional quantity is less than or equal the current number of stock
                        $productEntity->quantity -= $delta;
                        // If it is deleting, increase stock quantity accordingly
                    } elseif ($delta < 0) {
                        $productEntity->quantity += abs($delta);
                    }
                }

                // Update session cart item
                $cart[$cartItemId]['quantity'] = $newQuantity;
                $cart[$cartItemId]['line_price'] = $cart[$cartItemId]['price'] * $newQuantity;

                $session->write('Cart', $cart);

                if ($this->CartItems->Products->save($productEntity)) {
                    $response = [
                        'success' => true,
                        'line_price' => $cart[$cartItemId]['line_price'],
                        'total_price' => array_sum(array_column($cart, 'line_price')),
                    ];
                } else {
                    $response = ['success' => false, 'message' => 'Failed to update product stock.'];
                }
            }
        }

        // Set the response data and serialize it to JSON
        $this->set(compact('response'));
        $this->viewBuilder()->setOption('serialize', ['response']);
        $this->viewBuilder()->disableAutoLayout(); // Disable the layout rendering
        $this->render(null, null); // Render the response without a view
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

            if ($cartItem) {
                $product = $this->CartItems->Products->get($cartItem->product_id);
                $existingQuantity = $cartItem->quantity;
                // Update the net stock amount of product when user successfully delete cart item
                $product->quantity += $existingQuantity;
                if ($this->CartItems->Products->save($product)) {
                    $this->Flash->success(__('Cart updated and stock increased.'));
                } else {
                    $this->Flash->error(__('Cart updated, but unable to update the product stock.'));
                }
                if ($this->CartItems->delete($cartItem)) {
                    $this->Flash->success(__('The cart item has been deleted.'));
                }
            } else {
                $this->Flash->error(__('Unable to delete the cart item. Please, try again.'));
            }
        } else {
            // Delete from session for unauthenticated users
            $session = $this->request->getSession();
            $cart = $session->read('Cart') ?? [];

            if (isset($cart[$id])) {
                $product =  $this->CartItems->Products->get($cart[$id]['product_id']);
                $existingQuantity = $cart[$id]['quantity'];
                // Update the net stock amount of product when user successfully delete cart item
                $product->quantity += $existingQuantity;
                if ($this->CartItems->Products->save($product)) {
                    $this->Flash->success(__('Cart updated and stock increased.'));
                } else {
                    $this->Flash->error(__('Cart updated, but unable to update the product stock.'));
                }
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
        $selected_quantity = $this->request->getData('quantity') ?? 1;

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

            // If item already existed in cart, only increase quantity of that item in cart
            if (!is_null($existingItem)) {
                // Validate the selected quantity
                if ($selected_quantity <= 0) {
                    $this->Flash->error(__('Please select at least one item to add to the cart.'));

                    return $this->redirect($this->referer());
                }

                // Update the quantity and recalculate the line price
                $existingItem->quantity += $selected_quantity;

                if ($this->CartItems->save($existingItem)) {
                    // Update the net stock amount of product when user successfully add to cart
                    $product->quantity -= $selected_quantity;
                    if ($this->CartItems->Products->save($product)) {
                        $this->Flash->success(__('Cart updated and stock decreased.'));
                    } else {
                        $this->Flash->error(__('Cart updated, but unable to update the product stock.'));
                    }

                    $this->Flash->success(__('Cart updated with ' . $selected_quantity . 'more unit(s) of "' . $product->name . '".'));
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
                    // Update the net stock amount of product when user successfully add to cart
                    $product->quantity -= $selected_quantity;
                    if ($this->CartItems->Products->save($product)) {
                        $this->Flash->success(__('Cart updated and stock decreased.'));
                    } else {
                        $this->Flash->error(__('Cart updated, but unable to update the product stock.'));
                    }
                    $this->Flash->success(__($selected_quantity . ' unit(s) of "' . $product->name . '" has been added to your cart.'));
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
            $this->Flash->success(__($selected_quantity . ' unit(s) of "' . $product->name . '" has been added to your cart.'));
            // Update the net stock amount of product when user successfully add to cart
            $product->quantity -= $selected_quantity;
            if ($this->CartItems->Products->save($product)) {
                $this->Flash->success(__('Cart updated and stock decreased.'));
            } else {
                $this->Flash->error(__('Cart updated, but unable to update the product stock.'));
            }
        }

        // Redirect back to the referring page (or to a dedicated cart view)
        return $this->redirect($this->referer());
    }
    
    /**
     * Generate a random tracking number
     *
     * @return string Random tracking number
     */
    private function generateTrackingNumber(): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $length = 20; // Length of the tracking code
        $trackingNumber = 'TRK';

        for ($i = 0; $i < $length; $i++) {
            $trackingNumber .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $trackingNumber;
    }

    public function authenticatedCheckout()
    {
        // Get the current user identity
        $user = $this->Authentication->getIdentity();
        $userId = $user->get('id');
        $recipient = $user->get('email');

        $this->Flash->success(__('Order confirmation will be sent to: ' . $recipient));

        // Retrieve cart items for the current user including associated product info
        $cartItems = $this->CartItems->find('all')
            ->contain(['Products'])
            ->where(['CartItems.user_id' => $userId])
            ->toArray();

        // Check if the cart is empty
        if (empty($cartItems)) {
            $this->Flash->error(__('Your cart is empty.'));
            return $this->redirect(['action' => 'customerView']);
        }

        // Get the destination address from the form
        $destinationAddress = $this->request->getData('destination_address');
        if (empty($destinationAddress)) {
            $this->Flash->error(__('Please provide a valid destination address.'));
            return $this->redirect(['action' => 'customerView']);
        }

        // Calculate the total amount
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->line_price;
        }

        // Generate a tracking number
        $trackingNumber = $this->generateTrackingNumber();

        try {
            // Override received email to cpanel email for testing
            // Configure::load('app_local');
            // $override_email = Configure::read('EmailTransport.default.username');
            // $override_email = $override_email ?? $recipient;

            $mailer = new Mailer('default');
            $mailer
                ->setEmailFormat('both') // sends both html and text versions
                // Override received email to cpanel email for testing
                ->setTo($recipient)
            //    ->setTo($override_email)
                ->setSubject('Your Order Confirmation')
                ->viewBuilder()
                ->setTemplate('customer_checkout');

            // Pass required variables to email template
            $mailer->setViewVars([
                'trackingNumber' => $trackingNumber,
                'email' => $recipient,
                'cartItems' => $cartItems,
                'total' => $total,
            ]);

            if (!$mailer->deliver()) {
                $this->Flash->error(__('We encountered an issue sending your order confirmation email. Please try again.'));
                return $this->redirect(['action' => 'customerView']);
            }

            // Process the order --------------------------------
            
            // Create the order entity
            $order = $this->CartItems->Orders->newEmptyEntity();
            $order = $this->CartItems->Orders->patchEntity($order, [
                'tracking_number' => $trackingNumber,
                'user_email' => $recipient,
                'status' => 'pending',
                'origin_address' => 'Origin Address', // Placeholder for now, will need to make a global config for this
                'destination_address' => $destinationAddress,
                'estimated_delivery_date' => date('Y-m-d H:i:s', strtotime('+7 days')), // 7 days from now
                'total' => $total,
            ]);

            // Save the order
            if ($this->CartItems->Orders->save($order)) {
                // Convert cart items to order items
                foreach ($cartItems as $cartItem) {
                    $orderItem = $this->CartItems->Orders->OrderItems->newEmptyEntity();
                    $orderItem = $this->CartItems->Orders->OrderItems->patchEntity($orderItem, [
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                    ]);
                    $this->CartItems->Orders->OrderItems->save($orderItem);
                }
                
                // Clear the cart items for this user
                $this->CartItems->deleteAll(['user_id' => $userId]);
                $this->Flash->success(__('Your order has been processed and a confirmation email has been sent.'));
            } else {
                $this->Flash->error(__('Unable to place your order. Please try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('Error sending email to ' . $user->get('email') . '. The provided email address may not exist, please check the email address and try again.'));
            return $this->redirect(['action' => 'customerView']);
        }

        return $this->redirect(['controller' => 'Products', 'action' => 'customerIndex']);
    }

    public function unauthenticatedCheckout()
    {
        // Retrieve guest email from the posted form data
        $recipient = $this->request->getData('guest_email');

        // Server-side validation: Check if the email is empty or invalid
        if (empty($recipient) || !filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            $this->Flash->error(__('Please enter a valid email address for order confirmation.'));
            // Redirect back to the cart view
            return $this->redirect($this->referer());
        }

        // Get the destination address from the form
        $destinationAddress = $this->request->getData('destination_address');
        if (empty($destinationAddress)) {
            $this->Flash->error(__('Please provide a valid destination address.'));
            return $this->redirect(['action' => 'customerView']);
        }

        // Retrieve cart items from the session for unauthenticated users
        $session = $this->request->getSession();
        $cart = $session->read('Cart') ?? [];

        if (empty($cart)) {
            $this->Flash->error(__('Your cart is empty.'));

            return $this->redirect(['action' => 'customerView']);
        }

        $cartItems = [];
        $total = 0;

        // For each cart item in the session, fetch detailed product information using product ID as key
        foreach ($cart as $productId => $item) {
                // Calculate line price: if item['line_price'] is not empty, use it; otherwise, calculate it
                $linePrice = $item['price'] * $item['quantity'];

                // Create a product object to match the email template expectation
                $productObj = new stdClass();
                $productObj->name = $item['name'];
                $productObj->price = $item['price'];

                // Create a cart item object that stores the product object, quantity, and line price
                $cartItem = new stdClass();
                $cartItem->product = $productObj;
                $cartItem->quantity = $item['quantity'];
                $cartItem->line_price = $linePrice;

                $cartItems[] = $cartItem;
                $total += $linePrice;
        }

        // Generate a tracking number
        $trackingNumber = $this->generateTrackingNumber();
        
        try {
            // Override received email to cpanel email for testing
            // Configure::load('app_local');
            // $override_email = Configure::read('EmailTransport.default.username');
            // $override_email = $override_email ?? $recipient;
            
            $mailer = new Mailer('default');
            $mailer
                ->setEmailFormat('both')
                ->setTo($recipient)
                // Override received email to cpanel email for testing
                // ->setTo($override_email)
                ->setSubject('Your Order Confirmation')
                ->viewBuilder()
                ->setTemplate('customer_checkout');

            $mailer->setViewVars([
                'trackingNumber' => $trackingNumber,
                'email' => $recipient,
                'cartItems' => $cartItems,
                'total' => $total,
            ]);

            if (!$mailer->deliver()) {
                $this->Flash->error(__('We encountered an issue sending your order confirmation email. Please try again.'));
                return $this->redirect(['action' => 'customerView']);
            }

            // Create the order entity
            $order = $this->CartItems->Orders->newEmptyEntity();
            $order = $this->CartItems->Orders->patchEntity($order, [
                'tracking_number' => $trackingNumber,
                'user_email' => $recipient,
                'status' => 'pending',
                'origin_address' => 'Origin Address', // Placeholder for now, will need to make a global config for this
                'destination_address' => $destinationAddress,
                'estimated_delivery_date' => date('Y-m-d H:i:s', strtotime('+7 days')), // 7 days from now
                'total' => $total,
            ]);

            // Save the order
            if ($this->CartItems->Orders->save($order)) {
                // Convert session cart items to order items
                foreach ($cart as $productId => $item) {
                    $orderItem = $this->CartItems->Orders->OrderItems->newEmptyEntity();
                    $orderItem = $this->CartItems->Orders->OrderItems->patchEntity($orderItem, [
                        'order_id' => $order->id,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                    ]);
                    $this->CartItems->Orders->OrderItems->save($orderItem);
                }
                
                // Clear the session cart
                $session->delete('Cart');
                $this->Flash->success(__('Your order has been processed and a confirmation email has been sent.'));
            } else {
                $this->Flash->error(__('Unable to place your order. Please try again.'));
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

        

        $this->Authentication->allowUnauthenticated(['customerView', 'customerAdd', 'updateQuantityAjax', 'delete', 'clearCart', 'update', 'unauthenticatedCheckout']);
        if ($this->request->getParam('action') === 'updateQuantityAjax') {
            $this->Authorization->skipAuthorization();
            $this->getEventManager()->off($this->FormProtection);
        }
    }
}
