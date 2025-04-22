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

    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                <button id="filters-button" class="btn btn-outline-primary">
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
                        <!-- Predefined Price Range Checkboxes -->
                        <div class="form-check">
                            <input class="form-check-input price-checkbox" type="checkbox" name="price_range[]" value="under_20" id="price-under-20" <?= in_array('under_20', $this->request->getQuery('price_range') ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="price-under-20">
                                Under $20
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input price-checkbox" type="checkbox" name="price_range[]" value="20_50" id="price-20-50" <?= in_array('20_50', $this->request->getQuery('price_range') ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="price-20-50">
                                $20 - $50
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input price-checkbox" type="checkbox" name="price_range[]" value="50_100" id="price-50-100" <?= in_array('50_100', $this->request->getQuery('price_range') ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="price-50-100">
                                $50 - $100
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input price-checkbox" type="checkbox" name="price_range[]" value="100_plus" id="price-100-plus" <?= in_array('100_plus', $this->request->getQuery('price_range') ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="price-100-plus">
                                $100+
                            </label>
                        </div>

                        <!-- Enable Custom Price Range Checkbox -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="use-custom-range" name="use_custom_range" value="1" <?= $this->request->getQuery('use_custom_range') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="use-custom-range">
                                Custom Range
                            </label>
                        </div>

                        <!-- Custom Price Range Inputs -->
                        <div id="custom-range-container" class="mt-3" style="display: <?= $this->request->getQuery('use_custom_range') ? 'block' : 'none' ?>;">
                            <div class="d-flex justify-content-between">
                                <div class="input-group me-2">
                                    <span class="input-group-text">$</span>
                                    <input type="number" id="min-price" name="min_price" class="form-control custom-price-input" placeholder="Min" value="<?= h($this->request->getQuery('min_price') ?? '') ?>" min="0">
                                </div>
                                <div class="input-group ms-2">
                                    <span class="input-group-text">$</span>
                                    <input type="number" id="max-price" name="max_price" class="form-control custom-price-input" placeholder="Max" value="<?= h($this->request->getQuery('max_price') ?? '') ?>" min="0">
                                </div>
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
            const toggleFiltersButton = document.getElementById('filters-button');
            const filterSidebar = document.getElementById('filter-sidebar');
            const featuredProducts = document.getElementById('featured-products');

            toggleFiltersButton.addEventListener('click', function () {
                if (!filterSidebar.classList.contains('open')) {
                    // Show the sidebar
                    filterSidebar.classList.add('open');
                    filterSidebar.classList.remove('hidden');
                    // featuredProducts.style.width = '80%'; // Adjust featured-products width
                    toggleFiltersButton.innerHTML = 'Hide Filters <i class="fa fa-sliders"></i>';
                } else {
                    // Hide the sidebar
                    filterSidebar.classList.remove('open');
                    filterSidebar.classList.add('hidden');
                    // featuredProducts.style.width = '100%'; // Expand featured-products to full width
                    toggleFiltersButton.innerHTML = 'Show Filters <i class="fa fa-sliders"></i>';
                }
            });
        });
    </script>

    <!-- Filter script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const useCustomRangeCheckbox = document.getElementById('use-custom-range');
            const customRangeContainer = document.getElementById('custom-range-container');
            const customPriceInputs = document.querySelectorAll('.custom-price-input');
            const priceCheckboxes = document.querySelectorAll('.price-checkbox');

            // Toggle visibility of custom range container
            useCustomRangeCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    customRangeContainer.style.display = 'block';
                    customPriceInputs.forEach(input => input.disabled = false);
                    priceCheckboxes.forEach(checkbox => {
                        checkbox.disabled = true;
                        checkbox.checked = false;
                    });
                } else {
                    customRangeContainer.style.display = 'none';
                    customPriceInputs.forEach(input => {
                        input.disabled = true;
                        input.value = '';
                    });
                    priceCheckboxes.forEach(checkbox => checkbox.disabled = false);
                }
            });

            // Initialize state on page load
            if (useCustomRangeCheckbox.checked) {
                customRangeContainer.style.display = 'block';
                customPriceInputs.forEach(input => input.disabled = false);
                priceCheckboxes.forEach(checkbox => {
                    checkbox.disabled = true;
                    checkbox.checked = false;
                });
            } else {
                customRangeContainer.style.display = 'none';
                customPriceInputs.forEach(input => input.disabled = true);
            }
        });
    </script>
</body>

</html>
