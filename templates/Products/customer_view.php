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

<?php
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;
$html = new HtmlHelper(new View());
?>


<head>
    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities','shop','products']) ?>

</head>

<body>
    <!-- Page Breadcrumb -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Products" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerIndex']) ?>">Products</a></li>
                <li class="active">
                    <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerView', $product->id]) ?>">
                        <?= h($product->name) ?>
                    </a>
                </li>

            </ol>
        </div>
    </div>


    <!-- Page -->
    <div id="shop-container" class="single-product">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-7">
                    <!-- Product Image -->
                    <div id="shop-box" class="large-product" style="margin-bottom: 40px;">
                        <div class="page-header" style="padding: 20px;">
                            <h3><?= h($product->name) ?></h3>
                        </div>
                        <!-- Admin manage this product buttons -->
                        <?php if ($this->Identity->isLoggedIn() && $this->Identity->get('role') === 'admin') : ?>
                            <div class="text-center mb-3">
                                <a href="<?= $this->Url->build(['action' => 'view', $product->id]) ?>" class="btn btn-info me-2">View</a>
                                <a href="<?= $this->Url->build(['action' => 'edit', $product->id]) ?>" class="btn btn-warning me-2">Edit</a>
                                <?= $this->Form->postLink(
                                    'Delete',
                                    ['action' => 'delete', $product->id],
                                    [
                                        'class' => 'btn btn-danger',
                                        'confirm' => __('Are you sure you want to delete {0}?', $product->name),
                                    ]
                                ) ?>
                            </div>
                        <?php endif; ?>
                        <div class="row" style="display: flex; justify-content: center; align-items: center;">
                            <div id="about-slider" class="col-12 col-md-12 col-lg-9 flexslider product-slider" style="border: 0;">
                                <ul class="slides">
                                    <?= $this->Html->image($product->image_cache_busted_url, [
                                        'alt' => $product->name,
                                        'class' => 'img-fluid ',
                                        'style' => 'height: fit-content; object-fit: cover; width: fit-content;']) ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Similar Products Section -->
                    <div id="shop-box" style="padding: 20px;">
                        <div class="page-header" style="padding: 20px;">
                            <h3>Similar Products</h3>
                        </div>
                        <div class="row">
                            <?php foreach ($similarProducts as $similarProduct) : ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 main-product">
                                    <div class="category-box product-box" style="border: 0;">
                                        <?php if ($similarProduct->on_sale) : ?>
                                            <span class="sale">sales</span>
                                        <?php endif; ?>
                                        <div class="inner-product" >
                                            <!-- Link the product image to the view page -->
                                            <a href="<?= $this->Url->build(['action' => 'customerView', $similarProduct->id]) ?>">
                                                <?= $this->Html->image($similarProduct->image_cache_busted_url, [
                                                    'alt' => $similarProduct->name,
                                                    'class' => 'img-fluid'
                                                ]) ?>
                                            </a>
                                            <div class="product-box-inner">
                                                <ul>
                                                    <li>
                                                        <a title="View Image" href="<?= $this->Url->build($similarProduct->image_cache_busted_url) ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <a title="Add to Cart" href="<?= $this->Url->build(['controller' => 'CartItems', 'action' => 'customerAdd', $similarProduct->id]) ?>" class="btn">add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Link the product title to the view page -->
                                    <a title="<?= h($similarProduct->name) ?>" href="<?= $this->Url->build(['action' => 'customerView', $similarProduct->id]) ?>" class="product-title">
                                        <?= h($similarProduct->name) ?>
                                    </a>
                                    <div class="ratings">
                                        <ul class="star">
                                            <li>
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <i class="fa <?= $i <= $similarProduct->rating ? 'fa-star' : 'fa-star-o' ?>"></i>
                                                <?php endfor; ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <span class="amount coupon-amount">
                                            <?= $this->Number->currency($similarProduct->price, 'AUD') ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-12 col-md-12 col-lg-5 single-product-sidebar">
                    <div id="shop-box" class="product-info-panel" style="padding: 40px; margin-bottom: 20px;">
                        <div class="page-header">
                            <h3>Product Details</h3>
                        </div>
                        <ul class="star" style="margin-bottom: 20px;">
                            <li>
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <i class="fa <?= $i <= $product->rating ? 'fa-star' : 'fa-star-o' ?>"></i>
                                <?php endfor; ?>
                            </li>
                        </ul>
                        <p><strong>Availability:</strong></p>
                        <p style="margin-bottom: 40px; color: <?= $product->quantity > 0 ? 'inherit' : 'red' ?>;">
                            <?= $product->quantity > 0 ? 'In Stock' : 'Out of Stock' ?>
                        </p>
                        <?php if (!empty($associatedCategoryIds) && !empty($allCategories)) : ?>
                            <p><strong>Associated Categories:</strong></p>
                            <ul>
                                <!-- Display categories with commas inbetween by looking up the associated category id and using implode -->
                                <?php $categoryNames = []; ?>
                                <?php foreach ($associatedCategoryIds as $categoryId) : ?>
                                    <?php if (isset($allCategories[$categoryId])) : ?>
                                        <?php $categoryNames[] = h($allCategories[$categoryId]); ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if (!empty($categoryNames)) : ?>
                                    <li><?= implode(', ', $categoryNames) ?></li>
                                <?php endif; ?>
                            </ul>
                        <?php else : ?>
                            <p>No associated categories available.</p>
                        <?php endif; ?>
                        <!-- Could use padding instead here                       -->
                        <br>
                        <p><strong>Description:</strong></p>
                        <p><?= h($product->description) ?></p>
                        <p><strong>Ingredients:</strong></p>
                        <p><?= h($product->ingredients) ?></p>
                    </div>

                    <aside id="shop-box" class="widget widget_recent_post">
                        <div role="tabpanel">
                            <ul class="nav nav-tabs bottom-shadow" role="tablist">
                                <li class="nav-item" role="presentation"><a title="Pricing" id="pricingtab"
                                class="nav-link active" data-bs-toggle="tab" role="tab" aria-controls="pricing"
                                    data-bs-target="#pricing" aria-selected="true">Pricing</a></li>
                                <!-- <li class="nav-item" role="presentation"><a title="Reviews" id="reviewtab"
                                    class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="reviews"
                                    data-bs-target="#reviews" aria-selected="false">Reviews</a></li> -->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pricing" role="tabpanel" aria-labelledby="pricingtab">
                                    <div class="shopping-cart-table">
                                        <!-- Create a CakePHP Form -->
                                        <?= $this->Form->create(null, [
                                            'url' => ['controller' => 'CartItems', 'action' => 'customerAdd', $product->id],
                                            'type' => 'post',
                                        ]) ?>
                                        <table>
                                            <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Product Price</th>
                                                <td><span class="amount"><?= $this->Number->currency($product->price, 'AUD') ?></span></td>
                                            </tr>
                                            <tr class="cart-subtotal">
                                                <th>Product Quantity</th>
                                                <td>
                                                    <?= $this->Form->select('quantity', array_combine(range(1, 10), range(1, 10)), [
                                                        'class' => 'minimal',
                                                        'id' => 'quantity',
                                                        'value' => $this->request->getData('quantity'),
                                                        'data-stock' => $product->quantity,
                                                        'data-cart' => $cartQuantity,
                                                    ]) ?>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Total Price</th>
                                                <td><strong><span id="total-amount" class="total-amount"><?= $this->Number->currency($product->price, 'AUD') ?></span></strong></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <!-- Add Submit Button -->
                                        <ul>
                                            <li><?= $this->Form->button(__('Add to cart'), ['type' => 'submit', 'class' => 'btn btn-danger', 'style' => 'font-size: 0.9em; padding: 1em;']) ?></li>
                                        </ul>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviewtab">
                                    <div class="shopping-cart-table">
                                        <div class="review-box">
                                            <div class="col-md-5 col-sm-5">
                                                <h3>Review Title:</h3>
                                            </div>
                                            <div class="col-md-7 col-sm-7">
                                                <input type="text" placeholder="(Maximum 20 words)" />
                                            </div>
                                        </div>
                                        <div class="review-box">
                                            <div class="col-md-5 col-sm-5">
                                                <h3>Your Review:</h3>
                                            </div>
                                            <div class="col-md-7 col-sm-7">
                                                <textarea placeholder="(at least 100 characters.)"></textarea>
                                            </div>
                                            <p>Please do not include: HTML, references to other retailers, pricing,
                                                personal information, any profane, inflammatory or copyrighted comments,
                                                or any copied content.</p>
                                        </div>
                                        <div class="review-box">
                                            <div class="col-md-5 col-sm-5">
                                                <h3>Review Title:</h3>
                                            </div>
                                            <div class="col-md-7 col-sm-7">
                                                <p>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    (Click to rate on scale of 1-5)
                                                </p>
                                            </div>
                                        </div>
                                        <div class="review-box">
                                            <div class="col-md-5 col-sm-5">
                                                <h3>Name</h3>
                                            </div>
                                            <div class="col-md-7 col-sm-7">
                                                <input type="text" placeholder="(First and last name)" />
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Line price on Quantity dropdown    -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Get the necessary elements
            const quantityDropdown = document.getElementById('quantity');
            const totalPriceElement = document.getElementById('total-amount');
            const productPrice = <?= json_encode($product->price) ?>; // Pass product price from PHP to JavaScript

            // Add an event listener to the dropdown
            quantityDropdown.addEventListener('change', () => {
                const selectedQuantity = parseInt(quantityDropdown.value, 10); // Get selected quantity
                const totalPrice = (selectedQuantity) * productPrice; // Calculate total price

                // Update the total price element
                totalPriceElement.textContent = `A$ ${totalPrice.toFixed(2)}`; // Format as currency
            });
        });
    </script>

    <!-- Restrict Quality dropdown script based on number of available stock-->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const quantityDropdown = document.getElementById('quantity');
            const stockCount = parseInt(quantityDropdown.dataset.stock, 10); // Total stock for the product
            // const cartQuantity = parseInt(quantityDropdown.dataset.cart, 10); // Quantity already in the cart

            // Iterate through each option in the dropdown
            Array.from(quantityDropdown.options).forEach(option => {
                const optionValue = parseInt(option.value, 10); // Get the value of the option

                // Check if the quantity option exceeds the number of available stock
                if (optionValue > stockCount) {
                    option.style.color = "#e0e0e0";
                    option.disabled = true;
                } else {
                    option.style.color = '';
                    option.disabled = false;
                }
            });
        });
    </script>


</html>
