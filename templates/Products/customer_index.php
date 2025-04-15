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

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
?>

<head>
    <!-- <?= $this->Html->charset() ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?= $this->Url->image('logo.png') ?>">
    <title><?= $this->fetch('title') ?> - CrunchyCravings</title> -->
    
    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities','shop']) ?>

    <!-- Load jQuery -->
    <?= $this->Html->script('libraries/jquery.min') ?>
    <?= $this->Html->script('libraries/fuelux/jquery-ui.min') ?>

</head>

<body>
    <!-- Page Breadcrumb -->
    <!-- container -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Products" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerIndex']) ?>">Products</a></li>
            </ol>
            <div class="return-home-link pull-right">
                <a title="Return to home page" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">return to home page</a>
            </div>
        </div>
    </div><!-- container /- -->
    <!-- Page Breadcrumb /- -->

    <div id="shop-container">
        <!-- Product Filter -->
        <div class="container">
            <div id="shop-box" class="product-filter-box">
                <!-- Begin Filter Form -->
                <?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'customerIndex']]) ?>
                <div class="row">
                    <!-- Price Range Slider -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <h4>Filter by Price</h4>
                        <div id="slider-range"></div>
                        <div class="price-input row">
                            <!-- Min Price Field -->
                            <div class="col-6">
                                <?= $this->Form->control('min_price', [
                                    'id' => 'min-price',
                                    'label' => 'From:',
                                    'placeholder' => 'min',
                                    'type' => 'number',
                                    'min' => '0',
                                    'max' => '999999',
                                    'value' => $this->request->getQuery('min_price'),
                                    'class' => 'form-control',
                                ]) ?>
                            </div>
                            <!-- Max Price Field -->
                            <div class="col-6">
                                <?= $this->Form->control('max_price', [
                                    'id' => 'max-price',
                                    'label' => 'To:',
                                    'placeholder' => 'max',
                                    'type' => 'number',
                                    'min' => '0',
                                    'max' => '999999',
                                    'value' => $this->request->getQuery('max_price'),
                                    'class' => 'form-control',
                                ]) ?>
                            </div>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="col-12 col-md-6 col-lg-8">
                        <h4>Filter by Categories</h4>
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

                        <!-- Submit Button -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Apply Filters</button>
                            <a href="<?= $this->Url->build(['action' => 'customerIndex']) ?>" class="btn btn-danger">Clear Filters</a>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <!-- End Filter Form -->
            </div>
        </div>
        <!-- Product Filter /- -->

        <!-- Feature Product -->
        <div id="shop-box" class="container">
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
                                        <a href="<?= $this->Url->build(['action' => 'customerView', $product->id]) ?>">
                                            <?= $this->Html->image($product->image_full_path, ['alt' => $product->name, 'class' => 'img-thumbnail', 'style' => 'width: 300px; height: 300px; object-fit: cover;']) ?>
                                        </a>
                                        <div class="product-box-inner">
                                            <ul>
                                                <li>
                                                    <a title="View Image" href="<?= $this->Url->build($product->image_full_path) ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a title="Add to Wishlist" href="#">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                            <a title="Add to Cart" href="<?= $this->Url->build(['controller' => 'CartItems', 'action' => 'customerAdd', $product->id]) ?>" class="btn">add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Link the product title to the view page -->
                                <a title="<?= h($product->name) ?>" href="<?= $this->Url->build(['action' => 'customerView', $product->id]) ?>" class="product-title">
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
                    <img alt="loading icon" src="<?= $this->Url->image('load.gif') ?>">
                    <p>click here for more products</p>
                </a>
            </div>
        </div><!-- shop-box /- -->
    </div>


    <!-- Include other libraries -->
    <?= $this->Html->script('libraries/gmap/jquery.gmap.min') ?>
    <?= $this->Html->script('libraries/jquery.easing.min') ?>
    <?= $this->Html->script('libraries/bootstrap/bootstrap.bundle.min') ?>
    <?= $this->Html->script('libraries/jquery.animateNumber.min') ?>
    <?= $this->Html->script('libraries/jquery.appear') ?>
    <?= $this->Html->script('libraries/jquery.knob') ?>
    <?= $this->Html->script('libraries/wow.min') ?>
    <?= $this->Html->script('libraries/owl-carousel/owl.carousel.min') ?>
    <?= $this->Html->script('libraries/expanding-search/modernizr.custom') ?>
    <?= $this->Html->script('libraries/flexslider/jquery.flexslider-min') ?>
    <?= $this->Html->script('libraries/jquery.magnific-popup.min') ?>


    <!-- Filter scripts -->
    <script>
        $(document).ready(function () {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 1000,
                values: [100, 800], // Static values for testing
                slide: function (event, ui) {
                    console.log("Slider moved:", ui.values);
                    $("#min-price").val(ui.values[0]);
                    $("#max-price").val(ui.values[1]);
                }
            });

            $("#min-price").val(100); // Set initial value manually
            $("#max-price").val(800);
        });
    </script>



    <!-- Customized Scripts -->
    <?= $this->Html->script('functions') ?>


</body>

</html>
