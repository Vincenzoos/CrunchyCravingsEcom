<?php
declare(strict_types=1);

namespace App\Controller;

// Used for cpanel testing
use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\Mailer\Mailer;
use Cake\Routing\Router;
use Cake\Utility\Text;
use Exception;
use stdClass;
use Stripe\Checkout\Session;
use function Cake\Error\debug;

/**
 * CartItems Controller
 *
 * @property \App\Model\Table\CartItemsTable $CartItems
 * @property \App\Model\Table\OrdersTable $Orders
 */
class CartItemsController extends AppController
{
    // TODO: Remove, add redirect to unused methods

    /**
     * Index method (not used)
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
//        $this->Flash->error(__('Page not found.'));
//
//        return $this->redirect(['action' => 'customerView']);
//        $query = $this->CartItems->find()->contain(['Users', 'Products']);
//        $cartItems = $this->paginate($query);
//
//        $this->set(compact('cartItems'));
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
     * View method (not used)
     *
     * @param string|null $id Cart Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
//        $this->Flash->error(__('Page not found.'));
//
//        return $this->redirect(['action' => 'customerView']);
//        $cartItem = $this->CartItems->get($id, contain: ['Users', 'Products']);
//        $this->set(compact('cartItem'));
    }

    /**
     * Add method (not used)
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
//        $cartItem = $this->CartItems->newEmptyEntity();
//        if ($this->request->is('post')) {
//            $cartItem = $this->CartItems->patchEntity($cartItem, $this->request->getData());
//            if ($this->CartItems->save($cartItem)) {
//                $this->Flash->success(__('The cart item has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The cart item could not be saved. Please, try again.'));
//        }
//        $users = $this->CartItems->Users->find('list', limit: 200)->all();
//        $products = $this->CartItems->Products->find('list', limit: 200)->all();
//        $this->set(compact('cartItem', 'users', 'products'));
    }

    /**
     * Edit method (not used)
     *
     * @param string|null $id Cart Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
//        $this->Flash->error(__('Page not found.'));
//
//        return $this->redirect(['action' => 'customerView']);
//        $cartItem = $this->CartItems->get($id, contain: []);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $cartItem = $this->CartItems->patchEntity($cartItem, $this->request->getData());
//            if ($this->CartItems->save($cartItem)) {
//                $this->Flash->success(__('The cart item has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The cart item could not be saved. Please, try again.'));
//        }
//        $users = $this->CartItems->Users->find('list', limit: 200)->all();
//        $products = $this->CartItems->Products->find('list', limit: 200)->all();
//        $this->set(compact('cartItem', 'users', 'products'));
    }

    /**
     * Update method (not used)
     *
     * @param string|null $id Cart Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function update(?string $id = null)
    {
//        if ($this->request->is('post')) {
//            // Get the current user identity
//            $identity = $this->Authentication->getIdentity();
//            $userId = $identity ? $identity->get('id') : null;
//
//            // Get the new quantity from the request
//            $quantity = $this->request->getData('quantity');
//
//            // Ensure the quantity is valid
//            if ($quantity < 1) {
//                $this->Flash->error(__('Quantity must be at least 1.'));
//
//                return $this->redirect($this->referer());
//            }
//
//            if ($userId) {
//                // Handle logged-in users (database-based cart)
//                $cartItem = $this->CartItems->get($id);
//
//                if (!$cartItem) {
//                    $this->Flash->error(__('Cart item not found.'));
//
//                    return $this->redirect($this->referer());
//                }
//
//                // Update the quantity and save
//                $cartItem->quantity = $quantity;
////                $cartItem->line_price = $cartItem->product->price * $quantity;
//
//                if ($this->CartItems->save($cartItem)) {
//                    $this->Flash->success(__('Cart item quantity updated successfully.'));
//                } else {
//                    $this->Flash->error(__('Unable to update cart item quantity. Please try again.'));
//                }
//            } else {
//                // Handle unauthenticated users (session-based cart)
//                $session = $this->request->getSession();
//                $cart = $session->read('Cart') ?? [];
//
//                if (!isset($cart[$id])) {
//                    $this->Flash->error(__('Cart item not found.'));
//
//                    return $this->redirect($this->referer());
//                }
//
//                // Fetch the product details dynamically
//                $product = $this->CartItems->Products->find()
//                    ->where(['CartItems.id' => $id])
//                    ->first();
//
//                if (!$product) {
//                    $this->Flash->error(__('Product not found.'));
//
//                    return $this->redirect($this->referer());
//                }
//
//                // Update the quantity and line price in the session cart
//                $cart[$id]['quantity'] = $quantity;
//                $cart[$id]['price'] = $product->price; // Ensure price is set
//                $cart[$id]['line_price'] = $product->price * $quantity; // Calculate line price
//
//                // Save the updated cart back to the session
//                $session->write('Cart', $cart);
//
//                $this->Flash->success(__('Cart item quantity updated successfully.'));
//            }
//        }
//
//        // Redirect back to the referring page
//        return $this->redirect($this->referer());
    }

    /**
     * Update Quantity Method (not used)
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
        // Block access ajax action using GET method
        // Block user to manually access the action (e.g. cart-items/update-quantity-ajax in URL)
        if ($this->request->is('get')) {
            $this->viewBuilder()->setTemplatePath('Error');
            $this->viewBuilder()->setTemplate('missing_template');

            return;
        }

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
        
        // First get the product entity to check stock availability
        $productEntity = null;
        
        // Check if the user is logged in
        $identity = $this->Authentication->getIdentity();
        $userId = $identity ? $identity->get('id') : null;
        
        if ($userId) {
            // For logged-in users, get product from cart item
            $cartItem = $this->CartItems->get($cartItemId, ['contain' => ['Products']]);
            if ($cartItem) {
                $productEntity = $this->CartItems->Products->get($cartItem->product_id);
            }
        } else {
            // For guests, get product directly
            $session = $this->request->getSession();
            $cart = $session->read('Cart') ?? [];
            
            if (isset($cart[$cartItemId])) {
                $productEntity = $this->CartItems->Products->get($cartItemId);
            }
        }
        
        // Now check if requested quantity exceeds available stock
        // Get current cart quantity to calculate the actual change
        $currentQuantity = 0;
        if ($userId && isset($cartItem)) {
            $currentQuantity = $cartItem->quantity;
        } elseif (isset($cart[$cartItemId])) {
            $currentQuantity = $cart[$cartItemId]['quantity'];
        }
        
        // Calculate change in quantity
        $quantityChange = $newQuantity - $currentQuantity;
        
        // Check if there's enough stock for the requested increase
        if ($quantityChange > 0 && $productEntity && $quantityChange > $productEntity->quantity) {
            $response = ['success' => false, 'message' => 'Not enough stock available for ' . $productEntity->name];
            $this->set('response', $response);
            $this->viewBuilder()->setOption('serialize', ['response']);
            return;
        }

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
                    // $this->Flash->success(__('Cart updated and stock increased.'));
                } else {
                    // $this->Flash->error(__('Cart updated, but unable to update the product stock.'));
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
                    // $this->Flash->success(__('Cart updated and stock increased.'));
                } else {
                    // $this->Flash->error(__('Cart updated, but unable to update the product stock.'));
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

                    // $this->Flash->success(__('Cart updated with ' . $selected_quantity . 'more unit(s) of "' . $product->name . '".'));
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

                    // $this->Flash->success(__($selected_quantity . ' unit(s) of "' . $product->name . '" has been added to your cart.'));
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
            // Update the net stock amount of product when user successfully add to cart
            $product->quantity -= $selected_quantity;
            if ($this->CartItems->Products->save($product)) {
                $this->Flash->success(__('Cart updated and stock decreased.'));
            } else {
                $this->Flash->error(__('Cart updated, but unable to update the product stock.'));
            }

            // $this->Flash->success(__($selected_quantity . ' unit(s) of "' . $product->name . '" has been added to your cart.'));
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

    /**
     * Processes the checkout for an order.
     *
     * @param string $recipient The email address of the recipient.
     * @param array $cartItems The list of cart items to be included in the order.
     * @param float $total The total price of the order.
     * @param string $destinationAddress The destination address for the order.
     * @param callable $clearCartCallback A callback function to clear the cart after processing.
     * @return bool True if the checkout process is successful, false otherwise.
     */
    private function processCheckout(
        string $recipient,
        array $cartItems,
        float $total,
        string $destinationAddress,
        callable $clearCartCallback,
    ) {
        try {
            // Generate a tracking number
            $trackingNumber = $this->generateTrackingNumber();

            // Save the order
            $order = $this->CartItems->Orders->newEmptyEntity();
            $order = $this->CartItems->Orders->patchEntity($order, [
                'tracking_number' => $trackingNumber,
                'user_email' => $recipient,
                'status' => 'pending',
                'origin_address' => '121 King Street, Melbourne Victoria 3000 Australia', // cannot use content block here since its only for view, not controller
                'destination_address' => $destinationAddress,
                'estimated_delivery_date' => date('Y-m-d H:i:s', strtotime('+2 days')), // 2 days from now, Crunchy Cravings default policy
                'total' => $total,
            ]);

            // Save the order to the database
            if ($this->CartItems->Orders->save($order)) {
                // Get cart items and save them as order items
                foreach ($cartItems as $cartItem) {
                    $orderItem = $this->CartItems->Orders->OrderItems->newEmptyEntity();
                    $orderItem = $this->CartItems->Orders->OrderItems->patchEntity($orderItem, [
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                    ]);
                    $this->CartItems->Orders->OrderItems->save($orderItem);
                }

                // Clear the cart
                $clearCartCallback();

                // Confirmation email -------------------------------------------------

                // Load email override configuration
                $overrideEmailEnabled = Configure::read('EmailTransport.override_enabled', false);
                $overrideEmail = Configure::read('EmailTransport.default.username');

                // Determine the final recipient email
                $finalRecipient = $overrideEmailEnabled && $overrideEmail ? $overrideEmail : $recipient;

                // Configure the email transport and template
                $mailer = new Mailer('default');
                $mailer
                    ->setEmailFormat('both')
                    ->setTo($finalRecipient) // Use the final recipient email
                    ->setSubject('Your Order Confirmation')
                    ->viewBuilder()
                    ->setTemplate('customer_checkout');

                // transfer required view variables to email template
                // Use original email address to display in the email (even if overridden)
                $mailer->setViewVars([
                    'trackingNumber' => $trackingNumber,
                    'email' => $recipient,
                    'cartItems' => $cartItems,
                    'total' => $total,
                ]);

                // Send the email and check for success
                if (!$mailer->deliver()) {
                    $this->Flash->error(__('We encountered an issue sending your order confirmation email. Please try again.'));

                    return false;
                }

                // Success message after saving order and sending email
                $this->Flash->success(__('Your order has been processed and a confirmation email has been sent.'));

                return true;
            } else {
                // Error when processing checkout, saving order and sending email
                $this->Flash->error(__('Unable to place your order. Please try again.'));

                return false;
            }
        } catch (Exception $e) {
            $this->Flash->error(__('Error sending email to ' . $recipient . '. The provided email address may not exist, please check the email address and try again.'));

            return false;
        }
    }

    /**
     * Handles the checkout process for authenticated users.
     *
     * This method retrieves the authenticated user's cart items, validates the input data,
     * calculates the total price, and creates a Stripe session for payment. It also temporarily
     * stores the order data in the session for later processing.
     *
     * @return \Cake\Http\Response|null Redirects to the Stripe payment page or back to the customer view on error.
     */
    public function authenticatedCheckout()
    {
        $user = $this->Authentication->getIdentity();
        $userId = $user->get('id');
        $recipient = $user->get('email');

        // Get cart items for the authenticated user
        $cartItems = $this->CartItems->find('all')
            ->contain(['Products'])
            ->where(['CartItems.user_id' => $userId])
            ->toArray();

        if (empty($cartItems)) {
            $this->Flash->error(__('Your cart is empty.'));

            return $this->redirect(['action' => 'customerView']);
        }

        // Get the destination address from the request
        $destinationAddress = $this->request->getData('destination_address');
        if (empty($destinationAddress)) {
            $this->Flash->error(__('Please provide a valid destination address.'));

            return $this->redirect(['action' => 'customerView']);
        }

        // Populate line items for Stripe
        $lineItems = [];
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'aud',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->product->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        // Calculate the total price of the checkout
        $total = array_sum(array_map(fn($item) => $item->line_price, $cartItems));

        // generate temp token
        $tempToken = Text::uuid();

        // Save order data temporarily
        $this->request->getSession()->write("PendingOrders.{$tempToken}", [
            'recipient' => $recipient,
            'cartItems' => $cartItems,
            'total' => $total,
            'destination_address' => $destinationAddress,
            'is_guest' => false,
        ]);

        // Create Stripe session
        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'client_reference_id' => $tempToken, // save token for webhook too
                'success_url' => Router::url([
                    'controller' => 'CartItems',
                    'action' => 'success',
                    '?' => ['session_id' => '{CHECKOUT_SESSION_ID}', 'token' => $tempToken],
                ], true),
                'cancel_url' => Router::url(['controller' => 'CartItems', 'action' => 'customerView'], true),
            ]);

            // Redirect to Stripe payment page
            return $this->redirect($session->url);
        } catch (Exception $e) {
            $this->Flash->error(__('Error: ' . $e->getMessage()));

            return $this->redirect(['action' => 'customerView']);
        }
    }

    /**
     * Handles the checkout process for unauthenticated users.
     *
     * This method validates the guest user's email and destination address, retrieves
     * cart items from the session, calculates the total price, and creates a Stripe
     * session for payment. It also temporarily stores the order data in the session
     * for later processing.
     *
     * @return \Cake\Http\Response|null Redirects to the Stripe payment page or back to the customer view on error.
     */
    public function unauthenticatedCheckout()
    {
        $recipient = $this->request->getData('guest_email');

        if (empty($recipient) || !filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            $this->Flash->error(__('Please enter a valid email address for order confirmation.'));

            return $this->redirect($this->referer());
        }

        // Get the destination address from the request
        $destinationAddress = $this->request->getData('destination_address');
        if (empty($destinationAddress)) {
            $this->Flash->error(__('Please provide a valid destination address.'));

            return $this->redirect(['action' => 'customerView']);
        }

        $cartSession = $this->request->getSession();
        $cart = $cartSession->read('Cart') ?? [];

        if (empty($cart)) {
            $this->Flash->error(__('Your cart is empty.'));

            return $this->redirect(['action' => 'customerView']);
        }

        $lineItems = [];
        $cartItems = [];
        $total = 0;
        foreach ($cart as $productId => $item) {
            // Populate cart items with product details in session
            $linePrice = $item['price'] * $item['quantity'];

            $productObj = new stdClass();
            $productObj->name = $item['name'];
            $productObj->price = $item['price'];

            $cartItem = new stdClass();
            $cartItem->product_id = $productId;
            $cartItem->product = $productObj;
            $cartItem->quantity = $item['quantity'];
            $cartItem->line_price = $linePrice;

            $cartItems[] = $cartItem;
            $total += $linePrice;

            # Populate line items for Stripe
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'aud',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    // Convert to cents since Stripe's API requires the unit_amount field
                    // to be specified in the smallest currency unit.
                    'unit_amount' => $item['price'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];
        }

        // generate temp token
        $tempToken = Text::uuid();

        // Save order data temporarily
        $this->request->getSession()->write("PendingOrders.{$tempToken}", [
            'recipient' => $recipient,
            'cartItems' => $cartItems,
            'total' => $total,
            'destination_address' => $destinationAddress,
            'is_guest' => true,
        ]);

        // Create Stripe session
        try {
            $stripeSession = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'client_reference_id' => $tempToken, // save token for webhook too
                'success_url' => Router::url([
                    'controller' => 'CartItems',
                    'action' => 'success',
                    '?' => ['session_id' => '{CHECKOUT_SESSION_ID}', 'token' => $tempToken],
                ], true),
                'cancel_url' => Router::url(['controller' => 'CartItems', 'action' => 'customerView'], true),
            ]);

            // Redirect to Stripe payment page
            return $this->redirect($stripeSession->url);
        } catch (Exception $e) {
            $this->Flash->error(__('Error: ' . $e->getMessage()));

            return $this->redirect(['action' => 'customerView']);
        }
    }

    /**
     * Handles the Stripe webhook endpoint.
     *
     * This method allows only POST requests and sets the HTTP response status
     * based on the success or failure of the webhook processing. It is used
     * to acknowledge receipt of events sent by Stripe.
     *
     * @return \Cake\Http\Response The HTTP response with the appropriate status code.
     */
    public function stripeWebhook()
    {
        $this->request->allowMethod(['post']);
        try {
            $this->response = $this->response->withStatus(200);
        } catch (Exception $e) {
            $this->response = $this->response->withStatus(400);
        }

        return $this->response;
    }

    /**
     * Handles the success callback after a successful payment.
     *
     * This method processes the order after a successful payment by retrieving the pending order
     * data from the session, clearing the cart, and finalizing the checkout process. It also ensures
     * that the session data for the pending order is cleared to prevent reprocessing.
     *
     * @return \Cake\Http\Response|null Redirects to the customer view page.
     */
    public function success()
    {
        // Skip authorization for this action
        $this->Authorization->skipAuthorization();
        // Allow unauthenticated access to this action
        $this->Authentication->addUnauthenticatedActions(['success']);

        // Retrieve the session and the token from the query parameters
        $session = $this->request->getSession();
        $token = $this->request->getQuery('token');

        // Validate the token
        if (!$token) {
            $this->Flash->error(__('Invalid access.'));

            return $this->redirect(['action' => 'customerView']);
        }

        // Retrieve the pending order data from the session
        $orderData = $this->request->getSession()->read("PendingOrders.{$token}");
        if (!$orderData) {
            $this->Flash->error(__('No pending order found or session expired.'));

            return $this->redirect(['action' => 'customerView']);
        }

        // Get the identity of the current user and check if the order is for a guest
        $identity = $this->request->getAttribute('identity');
        $isGuest = $orderData['is_guest'];

        // Define a callback to clear the cart after processing the order
        $clearCartCallback = function () use ($identity, $session, $isGuest) {
            if (!$isGuest && $identity) {
                // Clear the cart for logged-in users
                $this->CartItems->deleteAll(['user_id' => $identity->get('id')]);
            } else {
                // Clear the session cart for unauthenticated users
                $session->delete('Cart');
            }
        };

        // Process the checkout using the retrieved order data
        $this->processCheckout(
            $orderData['recipient'],
            $orderData['cartItems'],
            $orderData['total'],
            $orderData['destination_address'],
            $clearCartCallback,
        );

        // Clear the session data for the pending order, preventing reprocessing the order
        $this->request->getSession()->delete("PendingOrders.{$token}");

        // Redirect to the cart customer view page
        return $this->redirect(['action' => 'customerView']);
    }

    /**
     * Handles the cancellation of a payment.
     *
     * This method clears the pending order data from the session and displays
     * an error message to the user indicating that the payment was canceled.
     * It then redirects the user back to the customer view page.
     *
     * @return \Cake\Http\Response|null Redirects to the customer view page.
     */
    public function cancel()
    {
        $session = $this->request->getSession();
        $session->delete('PendingOrder');
        $this->Flash->error(__('Payment was canceled. You can try again.'));

        return $this->redirect(['action' => 'customerView']);
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

        $this->Authentication->allowUnauthenticated([
            'customerView',
            'customerAdd',
            'updateQuantityAjax',
            'delete',
            'clearCart',
            'update',
            'unauthenticatedCheckout',
            'success',
            'processCheckout',
            ]);
        if ($this->request->getParam('action') === 'updateQuantityAjax') {
            $this->Authorization->skipAuthorization();
            $this->getEventManager()->off($this->FormProtection);
        }
    }
}
