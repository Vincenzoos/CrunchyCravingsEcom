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
				<li><a title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
				<li><a title="Products" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index']) ?>">Products</a></li>
			</ol>
			<div class="return-home-link pull-right">
				<a title="Return to home page" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">return to home page</a>
			</div>
		</div>
	</div><!-- container /- -->
    <!-- Page Breadcrumb /- -->

    <!-- Product Filter -->
    <div class="product-filter">
        <div class="container">
            <div class="product-filter-box bottom-shadow">
                <div class="row">
                    <!-- Price Range Slider -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <h4>Filter by Price</h4>
                        <div id="slider-range"></div>
                        <div class="price-input">
                            <label>From: </label>
                            <input type="text" id="min-price" name="min_price" readonly value="<?= $this->request->getQuery('min_price') ?>">
                            <label>To: </label>
                            <input type="text" id="max-price" name="max_price" readonly value="<?= $this->request->getQuery('max_price') ?>">
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="col-12 col-md-6 col-lg-8">
                        <form method="get" action="<?= $this->Url->build(['action' => 'index']) ?>">
                            <h4>Filter by Categories</h4>
                            <div class="category-checkboxes">
                                <?php foreach ($categories as $category) : ?>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="categories[]"
                                            value="<?= h($category->id) ?>"
                                            id="category-<?= h($category->id) ?>"
                                            <?= in_array($category->id, (array)$this->request->getQuery('categories')) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="category-<?= h($category->id) ?>">
                                            <?= h($category->name) ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-3">
                                <button type="submit" class="btn btn-success">Apply Filters</button>
                                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-primary">Clear Filters</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Filter /- -->

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
                                    <img src="<?= h('img/products/default-product.jpg') ?>" alt="<?= h($product->name) ?>" />
                                </a>
                                <div class="product-box-inner">
                                    <ul>
                                        <li>
                                            <a title="View Image" href="<?= h('img/products/default-product.jpg') ?>">
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
            <img alt="loading icon" src="images/load.gif">
            <p>click here for more products</p>
        </a>
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

    <!-- Filter scripts -->
    <script>
        $(document).ready(function () {
            // Initialize the price slider
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 1000, // Adjust this max value based on your product price range
                values: [
                    <?= $this->request->getQuery('min_price') ?: 0 ?>,
                    <?= $this->request->getQuery('max_price') ?: 1000 ?>
                ],
                slide: function (event, ui) {
                    $("#min-price").val(ui.values[0]);
                    $("#max-price").val(ui.values[1]);
                }
            });

            // Set initial values for the price inputs
            $("#min-price").val($("#slider-range").slider("values", 0));
            $("#max-price").val($("#slider-range").slider("values", 1));
        });
    </script>

    <!-- Customized Scripts -->
    <script src="js/functions.js"></script>


</body>

</html>
