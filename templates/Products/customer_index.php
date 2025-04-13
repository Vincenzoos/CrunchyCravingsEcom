<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 * @var \Cake\Collection\CollectionInterface|array<string> $categoriesList
 */

?>

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

<body>
    <!-- Page Breadcrumb -->
    <!-- container -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="index.html">Home</a></li>
                <li><a title="Clothing" href="#">Clothing</a></li>
                <li class="active">Our products</li>
            </ol>
            <div class="return-home-link pull-right">
                <a title="Return to home page" href="index.html">return to home page</a>
            </div>
        </div>
        <div class="page-header ow-bottom-padding categories">
            <h3>Our products</h3>
            <p><?= $this->Number->format($no_products) ?> Products</p>
        </div><!-- Section Header /- -->
    </div><!-- container /- -->
    <!-- Page Breadcrumb /- -->

    <!-- Product Filter -->
    <div class="product-filter">
        <div class="container">


            <!-- Product Filter Form -->
            <div class="mb-4 p-4 rounded shadow-sm bg-light">
                <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3']) ?>

                <!-- Product name Field -->
                <div class="col-md-3">
                    <?= $this->Form->control('product_name', [
                        'label' => 'Name',
                        'placeholder' => 'Product name contains...',
                        'value' => $this->request->getQuery('product_name'),
                        'class' => 'form-control',
                    ]) ?>
                </div>

                <!-- Price field -->
                <div class="col-md-3">
                    <?= $this->Form->control('min_price', [
                        'label' => 'Min Price',
                        'placeholder' => 'Product price ranges from...',
                        'value' => $this->request->getQuery('min_price'),
                        'class' => 'form-control',
                    ]) ?>
                </div>

                <div class="col-md-3">
                    <?= $this->Form->control('max_price', [
                        'label' => 'Max Price',
                        'placeholder' => 'Product price ranges to...',
                        'value' => $this->request->getQuery('max_price'),
                        'class' => 'form-control',
                    ]) ?>
                </div>


                <!-- Stock quantity field -->
                <div class="col-md-3">
                    <?= $this->Form->control('stock_quantity', [
                        'label' => 'Number of Stocks',
                        'placeholder' => 'Number of Stocks less than or equals...',
                        'value' => $this->request->getQuery('stock_quantity'),
                        'class' => 'form-control',
                    ]) ?>
                </div>


                <!-- Categories Field -->
                <div class="col-md-6">
                    <?= $this->Form->control('categories._ids', [
                        'label' => 'Categories',
                        'options' => $categoriesList,
                        'multiple' => true,
                        'class' => 'form-select',
                        'empty' => 'Select a category',
                        'value' => $this->request->getQuery('categories._ids'),
                    ]) ?>
                </div>

                <!-- Filter Button -->
                <div class="col-md-2 align-self-end">
                    <?= $this->Form->button(__('Filter'), ['class' => 'btn btn-success']) ?>
                    <?= $this->Html->link('Clear', ['action' => 'customerIndex'], ['class' => 'btn btn-danger']) ?>

                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    <!-- Feature Product -->
    <div id="featured-products" class="featured-products bottom-shadow">
        <!-- container -->
        <div class="container">
            <div class="category-box-main product-box-main">
                <div class="row">
                <?php foreach ($products as $product) : ?>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 main-product">
                        <div class="category-box product-box">
                            <?php if ($product->on_sale) : ?>
                                <span class="sale">sales</span>
                            <?php endif; ?>
                            <div class="inner-product">
                                <!-- Link the product image to the view page -->
                                <a href="<?= $this->Url->build(['action' => 'view', $product->id]) ?>">
                                    <img src="<?= $this->Url->assetUrl('img/products/default-product.jpg') ?>" alt="<?= h($product->name) ?>" />
                                </a>
                                <div class="product-box-inner">
                                    <ul>
                                        <li>
                                            <a title="View Image" href="<?= $this->Url->assetUrl('img/products/default-product.jpg') ?>">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a title="Add to Wishlist" href="#">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <a title="Add to Cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <!-- Link the product title to the view page -->
                        <a title="<?= h($product->name) ?>" href="<?= $this->Url->build(['action' => 'view', $product->id]) ?>" class="product-title">
                            <?= h($product->name) ?>
                        </a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount">
                            <?php if ($product->original_price) : ?>
                                <del>&dollar;<?= $this->Number->format($product->original_price) ?></del>
                            <?php endif; ?>
                            &dollar;<?= $this->Number->format($product->price) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div><!-- container /- -->
    </div>
    <!-- Feature Product /- -->

    <div class="loading">
        <a title="Click here for more products" href="#">
            <img alt="loading icon" src="<?= $this->Url->assetUrl('img/load.gif') ?>" />
            <p>click here for more products</p>
        </a>
    </div>

        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>


    <!-- jQuery Include -->
    <script src="libraries/jquery.min.js"></script>
    <!-- <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false'></script> -->
    <script src="libraries/gmap/jquery.gmap.min.js"></script> <!-- Light Box -->
    <script src="libraries/jquery.easing.min.js"></script><!-- Easing Animation Effect -->
    <script src="libraries/bootstrap/bootstrap.bundle.min.js"></script> <!-- Core Bootstrap v3.3.4 -->
    <script src="libraries/fuelux/jquery-ui.min.js"></script>
    <script src="libraries/jquery.animateNumber.min.js"></script> <!-- Used for Animated Numbers -->
    <script src="libraries/jquery.appear.js"></script> <!-- It Loads jQuery when element is appears -->
    <script src="libraries/jquery.knob.js"></script> <!-- Used for Loading Circle -->
    <script src="libraries/wow.min.js"></script> <!-- Use For Animation -->
    <script src="libraries/owl-carousel/owl.carousel.min.js"></script> <!-- Core Owl Carousel CSS File  *   v1.3.3 -->
    <script src="libraries/expanding-search/modernizr.custom.js"></script> <!-- Core Owl Carousel CSS File  *   v1.3.3 -->
    <script src="libraries/flexslider/jquery.flexslider-min.js"></script> <!-- flexslider   -->
    <script src="libraries/jquery.magnific-popup.min.js"></script> <!-- Light Box -->
</body>

</html>
