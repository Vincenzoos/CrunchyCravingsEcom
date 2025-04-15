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
    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities','shop','products']) ?>

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                    <div class="col-12 col-md-6 col-lg-6">
                        <h4>Filter by Price</h4>
                        <!-- <div id="slider-range"></div> -->
                        <div class="price-input row">
                            <!-- Min Price Field -->
                            <div class="col-12 col-md-6">
                                <?= $this->Form->control('min_price', [
                                    'id' => 'min-price',
                                    'label' => 'From:',
                                    'placeholder' => '0',
                                    'type' => 'number',
                                    'min' => '0',
                                    'max' => '500',
                                    'value' => $this->request->getQuery('min_price'),
                                    'class' => 'form-control',
                                ]) ?>
                            </div>
                            <!-- Max Price Field -->
                            <div class="col-12 col-md-6">
                                <?= $this->Form->control('max_price', [
                                    'id' => 'max-price',
                                    'label' => 'To:',
                                    'placeholder' => '500',
                                    'type' => 'number',
                                    'min' => '0',
                                    'max' => '500',
                                    'value' => $this->request->getQuery('max_price'),
                                    'class' => 'form-control',
                                ]) ?>
                            </div>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="col-12 col-md-6 col-lg-6">
                        <h4>Filter by Categories</h4>
                        <div class="col-12">
                            <?= $this->Form->control('categories._ids', [
                                'type' => 'select',
                                'label' => 'Categories',
                                'options' => $categoriesList,
                                'multiple' => true,
                                'class' => 'form-select select2', // use select2
                                'empty' => false, // Disable the empty option
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
                        <div class="container">
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
                                                    <?= $this->Html->image($product->image_cache_busted_url, [
                                                        'alt' => $product->name,
                                                        'class' => 'img-fluid rounded-top',
                                                        'style' => 'height: 300px; object-fit: cover; width: 100%;']) ?>
                                                </a>
                                                <div class="product-box-inner">
                                                    <ul>
                                                        <li>
                                                            <a title="View Image" href="<?= $this->Url->build($product->image_cache_busted_url) ?>">
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

    <!-- Select2 Initialization -->
    <script>
        jQuery(document).ready(function() {
            jQuery('.select2').select2({
                placeholder: "Select categories",
                allowClear: true
            });
        });
    </script>

    <!-- Filter scripts -->
    <!-- <script>
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            // Initialize the slider with absolute min and max values
            jQuery("#slider-range").slider({
                range: true,
                min: 1, // Absolute minimum
                max: 500, // Absolute maximum
                values: [
                    jQuery("#min-price").val() || 1, // Use the current min value or default to 1
                    jQuery("#max-price").val() || 500 // Use the current max value or default to 500
                ],
                slide: function(event, ui) {
                    // Update the input boxes when the slider is moved
                    jQuery("#min-price").val(ui.values[0]);
                    jQuery("#max-price").val(ui.values[1]);
                    console.log("Min Price: " + ui.values[0] + ", Max Price: " + ui.values[1]);
                }
            });

            // Update the slider when the input boxes are manually changed
            jQuery("#min-price, #max-price").on("change", function() {
                const minPrice = parseInt(jQuery("#min-price").val()) || 1;
                const maxPrice = parseInt(jQuery("#max-price").val()) || 500;

                // Ensure the values are within the slider's range
                if (minPrice < 1) jQuery("#min-price").val(1);
                if (maxPrice > 500) jQuery("#max-price").val(500);

                // Update the slider values
                jQuery("#slider-range").slider("values", [minPrice, maxPrice]);
            });

            // Set initial values in the input boxes
            jQuery("#min-price").val(jQuery("#slider-range").slider("values", 0));
            jQuery("#max-price").val(jQuery("#slider-range").slider("values", 1));
        });
    </script> -->


</body>

</html>
