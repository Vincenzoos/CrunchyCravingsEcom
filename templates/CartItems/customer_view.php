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
    <!-- container -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Products" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerIndex']) ?>">Products</a></li>
            </ol>
        </div>
    </div><!-- container /- -->
    <!-- Page Breadcrumb /- -->


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
                            <td data-title="Product" class="product-thumbnail">
                                <h5><?= h($cartItem->product->name) ?></h5>
                                <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'view', $cartItem->product->id]) ?>">
                                    <?= $this->Html->image($cartItem->product->image_cache_busted_url, [
                                        'alt' => $cartItem->product->name,
                                        'class' => 'img-fluid rounded-top',
                                        'style' => 'height: 100%; object-fit: cover; width: 80%;']) ?>
                                </a>
                            </td>
                            <td data-title="Description" class="product-description">
                                <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'view', $cartItem->product->id]) ?>">
                                    <?= h($cartItem->product->description) ?>
                                </a>
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
            <div class="row">
                <!-- col-md-4 -->
<!--                <div class="col-12 col-md-12 col-lg-4">-->
<!--                    <div class="section-header">-->
<!--                        <h3>estimate shipping and tax</h3>-->
<!--                    </div>-->
<!--                    <div class="estimate-details shopping-cart-table">-->
<!--                        <h4>Enter your destination to get a shipping estimate</h4>-->
<!--                        <form>-->
<!--                            <div class="form-group">-->
<!--                                <select class="form-control minimal">-->
<!--                                    <option selected="selected" value="">Select a country...</option>-->
<!--                                    <option value="Australia">Australia</option>-->
<!--                                    <option value="Canada">Canada</option>-->
<!--                                    <option value="United Kingdom">United Kingdom</option>-->
<!--                                    <option value="United States">United States</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <select class="form-control minimal">-->
<!--                                    <option selected="selected" value="">Select a state...</option>-->
<!--                                    <option value="Alabama">Alabama</option>-->
<!--                                    <option value="Alaska">Alaska</option>-->
<!--                                    <option value="Arizona">Arizona</option>-->
<!--                                    <option value="Arkansas">Arkansas</option>-->
<!--                                    <option value="Brisbane">Brisbane</option>-->
<!--                                    <option value="California">California</option>-->
<!--                                    <option value="Colorado">Colorado</option>-->
<!--                                    <option value="Connecticut">Connecticut</option>-->
<!--                                    <option value="Delaware">Delaware</option>-->
<!--                                    <option value="Florida">Florida</option>-->
<!--                                    <option value="Georgia">Georgia</option>-->
<!--                                    <option value="Melbourne">Melbourne</option>-->
<!--                                    <option value="Perth">Perth</option>-->
<!--                                    <option value="Sydney">Sydney</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <input type="text" name="zip" class="form-control" placeholder="zip/postal-code">-->
<!--                            </div>-->
<!--                            <input type="submit" value="get a quote" class="btn btn-default">-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-12 col-md-12 col-lg-4">-->
<!--                    <div class="section-header">-->
<!--                        <h3>Promo code</h3>-->
<!--                    </div>-->
<!--                    <div class="estimate-details shopping-cart-table coupon">-->
<!--                        <h4>Enter a coupon code</h4>-->
<!--                        <form>-->
<!--                            <div class="form-group">-->
<!--                                <input type="text" name="" class="form-control" placeholder="">-->
<!--                                <input type="submit" value="apply" class="btn">-->
<!--                            </div>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="col-12 col-md-12 col-lg-12">
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
                        <!-- Checkout for login user -->
                        <?php if ($this->Identity->isLoggedIn()) : ?>
                            <a title="Checkout" href="<?= $this->Url->build(['controller' => 'CartItems', 'action' => 'authenticatedCheckout']) ?>" class="btn btn-default">Checkout</a>
                        <?php else : ?>
                            <!-- Checkout for public (unauthenticated) user -->
                        <a title="Checkout" href="<?= $this->Url->build(['controller' => 'CartItems', 'action' => 'unauthenticatedCheckout']) ?>" class="btn btn-default">Checkout</a>
                        <?php endif; ?>
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
