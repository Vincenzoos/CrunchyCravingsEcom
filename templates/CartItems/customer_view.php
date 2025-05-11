<!doctype html>
<!--
**********************************************************************************************************
    Copyright (c) 2024 Webstrot Technology
********************************************************************************************************** -->
<!--
Template Name: Luxury Shop Ecommerce HTML Template
Version: 1.0.0
Author: webstrot
Website: http://webstrot.com/
Purchase: http://themeforest.net/user/webstrot  -->

<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class=""> <!--<![endif]-->

<sc?php
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;
$html = new HtmlHelper(new View());
?>

<head>
    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities','shop','cart']) ?>

</head>

<data-offset="200" data-spy="scroll" data-target=".primary-navigation">
    <!-- Page Breadcrumb -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Products" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerIndex']) ?>">Products</a></li>
            </ol>
        </div>
    </div>


    <!-- shop container -->
    <div id="shop-container" class="container">
        <!-- Shopping-cart-table -->
        <div id="shop-box" class="shopping-cart-table">
            <h1 class="text-center" style="padding: 1rem 0;">Shopping Cart</h1>
            <table class="shop_table cart">
                <thead>
                    <tr>
                        <th class="product-name">Product</th>
                        <th class="product-description">Description</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-subtotal">subtotal</th>
                        <th class="product-action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $cartItem) : ?>
                        <tr>
                            <td data-title="Product" class="product-thumbnail text-center">
                                <a style="color: #6E6E6E; display: block;" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerView', $cartItem->product->id]) ?>">
                                    <?= $this->Html->image($cartItem->product->image_cache_busted_url, [
                                        'alt' => $cartItem->product->name,
                                        'class' => 'img-fluid rounded',
                                        'style' => 'height: 70px; object-fit: cover; width: 70px; display: block; margin: 0 auto;']) ?>
                                    <h5 style="font-size: 0.9rem; margin-top: 0.5rem;"><?= h($cartItem->product->name) ?></h5>
                                </a>
                            </td>
                            <td data-title="Description" class="product-description">
                                <?= h($cartItem->product->description) ?>
                            </td>
                            <td data-title="Price" class="product-price">
                                <span class="price-amount"><?= $this->Number->currency($cartItem->product->price, 'AUD') ?></span>
                            </td>
                            <td data-title="Quantity" class="product-quantity">
                                <!-- <input type="number" class="qty form-control text-center" value="<?= h($cartItem->quantity) ?>" data-cart-item-id="<?= $cartItem->id ?>" readonly style="width: 50px; display: inline-block; font-size: 0.9rem;"> -->
                                <div class="d-flex flex-column align-items-center">
                                    <h class="quantity"><?= h($cartItem->quantity) ?></h>
                                    <div class="d-flex justify-content-center mt-1">
                                        <button class="qtyplus btn btn-outline-secondary btn-sm me-1" data-cart-item-id="<?= $cartItem->id ?>" data-action="increase">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <button class="qtyminus btn btn-outline-secondary btn-sm" data-cart-item-id="<?= $cartItem->id ?>" data-action="decrease">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td data-title="Subtotal" class="product-subtotal">
                                <span class="amount"><?= $this->Number->currency($cartItem->line_price, 'AUD') ?></span>
                            </td>
                            <td data-title="Action" class="product-action">
<!--                                --><?php //= $this->Html->link('<i class="fa fa-pencil-square-o"></i>', ['action' => 'edit', $cartItem->id], ['escape' => false, 'class' => 'product-edit']) ?>
                                <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['action' => 'delete', $cartItem->id], ['escape' => false, 'class' => 'product-delete', 'confirm' => __('Are you sure you want to delete this item ({0})?', $cartItem->product->name)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="shopping-cart-footer">
                <a title="Continue Shopping" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerIndex']) ?>" class="btn btn-default">&#8592; Continue Shopping</a>
<!--                <a title="Update Shopping Cart" href="--><?php //= $this->Url->build(['controller' => 'CartItems', 'action' => 'customerView']) ?><!--" class="btn btn-default">Update Shopping Cart</a>-->
            </div>
        </div> <!-- page /- -->
    </div> <!-- page container /- -->

    <!-- TODO: Either remove shipping and promo code, redo the layout or fully implementing them and keep the current layout   -->
    <!-- shop container -->
    <div id="shop-container" class="container">
        <!-- Shopping Cart Estimate Section -->
        <div id="shop-box" class="shopping-cart-estimate d-flex flex-column align-items-center justify-content-center">
            <h1>Shipping & Checkout</h1>
            <!-- Checkout Form -->
            <?= $this->Form->create(null, [
                'url' => $this->Identity->isLoggedIn()
                    ? ['controller' => 'CartItems', 'action' => 'authenticatedCheckout']
                    : ['controller' => 'CartItems', 'action' => 'unauthenticatedCheckout'],
            ]) ?>
            <div class="row">
                <!-- Email Input (for unauthenticated users) -->
                <?php if (!$this->Identity->isLoggedIn()) : ?>
                    <div class="col-12 mb-3">
                        <?= $this->Form->control('guest_email', [
                            'type' => 'email',
                            'class' => 'form-control',
                            'label' => ['text' => '<h4 class="text-center" style="margin-top: 1rem;">Email Address</h4>', 'escape' => false],
                            'placeholder' => 'Enter your email',
                            'required' => true,
                        ]) ?>
                    </div>
                <?php endif; ?>

                <!-- Destination Address Input -->
                <div class="col-12 mb-3">
                    <?= $this->Form->control('destination_address', [
                        'type' => 'text',
                        'class' => 'form-control',
                        'label' => ['text' => '<h4 class="text-center" style="margin-top: 1rem;">Destination Address</h4>', 'escape' => false],
                        'placeholder' => 'e.g., 123 Main St, Sydney, NSW 2000',
                        'required' => true,
                    ]) ?>
                </div>

                <!-- Totals and Checkout Button -->
                <div class="col-12 mb-3">
                    <div class="section-header">
                        <h3>Payment</h3>
                    </div>
                    <div class="estimate-details shopping-cart-table">
                        <table>
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td><span class="sub-total-amount"><?= $this->Number->currency($total_price, 'AUD') ?></span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Grand Total</th>
                                    <td><strong><span class="total-amount"><?= $this->Number->currency($total_price, 'AUD') ?></span></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <?= $this->Form->button('Checkout', ['class' => 'btn btn-default']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div> <!-- page /- -->
    </div> <!-- page container /- -->


    <!-- Send AJAX and update cart item without page reload  -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Handle quantity button clicks
            document.querySelectorAll('.qtyplus, .qtyminus').forEach(button => {
                button.addEventListener('click', event => {
                    const cartItemId = button.getAttribute('data-cart-item-id'); // Get the cart item ID
                    const action = button.getAttribute('data-action'); // Get the action (increase or decrease)
                    const quantityElement = button.closest('tr').querySelector('.quantity'); // Get the quantity element
                    let currentQuantity = parseInt(quantityElement.textContent, 10); // Get the current quantity

                    // Update the quantity based on the action
                    if (action === 'increase') {
                        currentQuantity++;
                    } else if (action === 'decrease' && currentQuantity > 1) {
                        currentQuantity--;
                    }

                    // Update the quantity in the DOM
                    quantityElement.textContent = currentQuantity;

                    // Send the updated quantity to the server via AJAX
                    fetch('<?= $this->Url->build(['controller' => 'CartItems', 'action' => 'updateQuantityAjax']) ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': '<?= $this->request->getAttribute('csrfToken') ?>'
                        },
                        body: JSON.stringify({ cart_item_id: cartItemId, quantity: currentQuantity })
                    })
                    .then(() => {
                        // Update the line price using currentQuantity and product price
                        const productPrice = parseFloat(button.closest('tr').querySelector('.product-price .price-amount').textContent.replace(/[^0-9.-]+/g, ""));
                        const linePriceElement = button.closest('tr').querySelector('.product-subtotal .amount');
                        const updatedLinePrice = productPrice * currentQuantity;
                        linePriceElement.textContent = formatCurrency(updatedLinePrice, 'AUD');

                        // Update the total price by recalculating all line prices
                        let updatedTotalPrice = 0;
                        document.querySelectorAll('.product-subtotal .amount').forEach(subtotalElement => {
                            updatedTotalPrice += parseFloat(subtotalElement.textContent.replace(/[^0-9.-]+/g, ""));
                        });
                        const subTotalPriceElement = document.querySelector('.sub-total-amount');
                        const totalPriceElement = document.querySelector('.total-amount');
                        subTotalPriceElement.textContent = formatCurrency(updatedTotalPrice);
                        totalPriceElement.textContent = formatCurrency(updatedTotalPrice);
                    })
                });
            });
        });
        // Helper function to format currency in JavaScript
        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-AU', { style: 'currency', currency: 'AUD' }).format(amount);
        }
    </script>
    <!-- End AJAX script -->

</body>

</html>
