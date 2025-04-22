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

    <!-- Shop container -->
    <div class="container" id="shop-container">
        <!-- Top Bar -->
        <div class="row align-items-center mb-3">
            <div class="col">
                <h4 class="mb-0">Products</h4>
            </div>
            <div class="col-auto d-flex align-items-center">
                <!-- Show/Hide Filters Button -->
                <button id="toggle-filters" class="btn btn-outline-primary">
                    Show Filters <i class="fa fa-sliders"></i>
                </button>

                <!-- Sort By Dropdown -->
                <div id="sort-dropdown">
                <button id="sort-button" class="btn btn-outline-secondary">
                    Sort By
                </button>
                <div id="sort-options" class="dropdown-menu">
                    <ul style="list-style-type: none; padding: 0; margin: 0;">
                        <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'newest'])]) ?>">Newest</a></li>
                        <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'price_desc'])]) ?>">Price: High-Low</a></li>
                        <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'price_asc'])]) ?>">Price: Low-High</a></li>
                    </ul>
                </div>
            </div>
            </div>
        </div>

        <div class="row" id="shop-container">
            <!-- Sidebar for Filters -->
            <div id="filter-sidebar" class="hidden">
                <?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'customerIndex']]) ?>

                <!-- Price Range Section -->
                <div class="mb-4">
                    <button class="btn w-100 mb-2 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#price-range-collapse" aria-expanded="false" aria-controls="price-range-collapse">
                        Price Range <i class="fa fa-chevron-down float-end"></i>
                    </button>
                    <div class="collapse" id="price-range-collapse">
                        <div id="slider-range" class="mb-3"></div>
                        <div class="d-flex justify-content-between">
                            <div class="input-group me-2">
                                <input type="number" id="min-price" name="min_price" class="form-control" placeholder="Min" value="<?= $this->request->getQuery('min_price') ?? 0 ?>" min="0" max="500">
                                <span class="input-group-text">$</span>
                            </div>
                            <div class="input-group ms-2">
                                <input type="number" id="max-price" name="max_price" class="form-control" placeholder="Max" value="<?= $this->request->getQuery('max_price') ?? 500 ?>" min="0" max="500">
                                <span class="input-group-text">$</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="mb-4">
                    <button class="btn w-100 mb-2 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#categories-collapse" aria-expanded="false" aria-controls="categories-collapse">
                        Categories <i class="fa fa-chevron-down float-end"></i>
                    </button>
                    <div class="collapse" id="categories-collapse">
                        <?= $this->Form->control('categories._ids', [
                            'type' => 'select',
                            'options' => $categoriesList,
                            'multiple' => true,
                            'class' => 'form-select select2',
                            'empty' => false,
                            'value' => $this->request->getQuery('categories._ids'),
                            'label' => false,
                        ]) ?>
                    </div>
                </div>

                <!-- Buttons Section -->
                <!-- <div class="text-center"> -->
                    <button type="submit" class="btn btn-success me-2">Apply</button>
                    <a href="<?= $this->Url->build(['action' => 'customerIndex']) ?>" class="btn btn-danger">Clear</a>
                <!-- </div> -->

                <?= $this->Form->end() ?>
            </div>
            <!-- Sidebar for Filters /- -->

            <!-- Feature Products -->
            <div id="featured-products" class="featured-products">
                <div class="category-box-main product-box-main">
                    <div class="row">
                        <?php foreach ($products as $product) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 main-product">
                                <div class="category-box product-box">
                                    <?php if ($product->on_sale) : ?>
                                        <span class="sale">sales</span>
                                    <?php endif; ?>
                                    <div class="inner-product">
                                        <!-- Link the product image to the view page -->
                                        <?= $this->Html->image($product->image_cache_busted_url, [
                                            'alt' => $product->name,
                                            'class' => 'img-fluid rounded-top',
                                        ]) ?>
                                        <div class="product-box-inner">
                                            <ul>
                                                <li>
                                                    <a title="View Image" href="<?= $this->Url->build($product->image_cache_busted_url) ?>">
                                                        <i class="fa fa-eye"></i>
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
                                    <?= $this->Number->currency($product->price, 'AUD') ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
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

    <!-- Sort Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sortButton = document.getElementById('sort-button');
            const sortOptions = document.getElementById('sort-options');

            // Toggle the visibility of the dropdown menu
            sortButton.addEventListener('click', function (event) {
                event.stopPropagation(); // Prevent the click from propagating to the document
                sortOptions.classList.toggle('show');
            });

            // Close the dropdown if clicked outside
            document.addEventListener('click', function (event) {
                if (!sortButton.contains(event.target) && !sortOptions.contains(event.target)) {
                    sortOptions.classList.remove('show');
                }
            });
        });
    </script>

    <!-- Filter sidebar toggle script and resuze featured products -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleFiltersButton = document.getElementById('toggle-filters');
            const filterSidebar = document.getElementById('filter-sidebar');
            const featuredProducts = document.getElementById('featured-products');

            toggleFiltersButton.addEventListener('click', function () {
                if (!filterSidebar.classList.contains('open')) {
                    // Show the sidebar
                    filterSidebar.classList.add('open');
                    filterSidebar.classList.remove('hidden');
                    featuredProducts.style.width = '80%'; // Adjust featured-products width
                    toggleFiltersButton.innerHTML = 'Hide Filters <i class="fa fa-sliders"></i>';
                } else {
                    // Hide the sidebar
                    filterSidebar.classList.remove('open');
                    filterSidebar.classList.add('hidden');
                    featuredProducts.style.width = '100%'; // Expand featured-products to full width
                    toggleFiltersButton.innerHTML = 'Show Filters <i class="fa fa-sliders"></i>';
                }
            });
        });
    </script>

    <!-- Filter script -->
    <script>
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
    </script>
</body>

</html>
