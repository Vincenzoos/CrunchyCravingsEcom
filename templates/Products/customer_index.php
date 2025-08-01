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
    <?= $this->Html->css(['utilities','shop','products','filter']) ?>

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
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->App->appUrl(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Products" href="<?= $this->App->appUrl(['controller' => 'Products', 'action' => 'customerIndex']) ?>">Products</a></li>
            </ol>
        </div>
    </div>

    <!-- Admin Manage products button -->
    <?php if ($this->Identity->isLoggedIn() && $this->Identity->get('role') === 'admin') : ?>
        <div class="text-center mb-3">
            <a href="<?= $this->App->appUrl(['controller' => 'Products', 'action' => 'index']) ?>" class="btn btn-danger">
                Manage Products
            </a>
        </div>
    <?php endif; ?>

    <!-- Shop container -->
    <div class="container" id="shop-container">
        <!-- Top Bar -->
        <div class="row align-items-center mb-3">
            <div class="col">
                <h4 class="mb-0">Products (<?= count($products) ?>)</h4>
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
                        <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'newest'])]) ?>">Newest</a></li>
                        <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'price_desc'])]) ?>">Price: High-Low</a></li>
                        <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'price_asc'])]) ?>">Price: Low-High</a></li>
                    </ul>
                </div>
            </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="d-flex" id="filter-container">
            <div id="filter-sidebar" class="closed">
                <h5>Filters</h5>
                <?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'customerIndex']]) ?>

                <!-- Product Name Field -->
                <div class="mb-4">
                    <button class="btn w-100 mb-2 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#name-collapse" aria-expanded="true" aria-controls="name-collapse">
                        Name <i class="fa fa-chevron-down float-end"></i>
                    </button>
                    <div class="show" id="name-collapse">
                        <?= $this->Form->control('product_name', [
                            'label' => false,
                            // 'label' => 'Product Name',
                            'placeholder' => 'Name contains...',
                            'value' => $this->request->getQuery('product_name'),
                            'class' => 'form-control',
                        ]) ?>
                    </div>
                </div>

                <!-- Price Range Section -->
                <div class="mb-4">
                    <button class="btn w-100 mb-2 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#price-range-collapse" aria-expanded="true" aria-controls="price-range-collapse">
                        Price Range <i class="fa fa-chevron-down float-end"></i>
                    </button>
                    <div class="show" id="price-range-collapse">
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
                                <div class="d-flex flex-wrap">
                                    <div class="input-group me-2 mb-2" style="flex: 1; min-width: 100px;">
                                        <span class="input-group-text">$</span>
                                        <input type="number" id="min-price" name="min_price" class="form-control custom-price-input" placeholder="Min" value="<?= h($this->request->getQuery('min_price') ?? '') ?>" min="0">
                                    </div>
                                    <div class="input-group me-2 mb-2" style="flex: 1; min-width: 100px;">
                                        <span class="input-group-text">$</span>
                                        <input type="number" id="max-price" name="max_price" class="form-control custom-price-input" placeholder="Max" value="<?= h($this->request->getQuery('max_price') ?? '') ?>" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="mb-4">
                    <button class="btn w-100 mb-2 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#categories-collapse" aria-expanded="true" aria-controls="categories-collapse">
                        Categories <i class="fa fa-chevron-down float-end"></i>
                    </button>
                    <div class="show" id="categories-collapse">
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
                    <a href="<?= $this->App->appUrl(['action' => 'customerIndex']) ?>" class="btn btn-danger">Clear</a>
                <!-- </div> -->

                <?= $this->Form->end() ?>
            </div>
            <!-- Sidebar for Filters /- -->

            <!-- Feature Products -->
            <div id="filter-content">
                <div class="category-box-main product-box-main">
                    <div class="row">
                        <?php foreach ($products as $product) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 main-product">
                                <div class="category-box product-box" style="border: 0;">
                                    <?php if ($product->on_sale) : ?>
                                        <span class="sale">sales</span>
                                    <?php endif; ?>
                                    <div class="inner-product">
                                        <a href="<?= $this->App->appUrl(['action' => 'customerView', $product->id]) ?>" class="product-image-link">
                                            <?= $this->Html->image($product->image_cache_busted_url, [
                                                'alt' => $product->name,
                                                'class' => 'img-fluid',
                                            ]) ?>
                                        </a>
                                        <div class="product-box-inner">
                                            <ul>
                                                <li>
                                                    <a title="View Image" href="<?= $this->Url->build($product->image_cache_busted_url) ?>" class="view-image-btn">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                            <a title="Add to Cart" href="<?= $this->App->appUrl(['controller' => 'CartItems', 'action' => 'customerAdd', $product->id]) ?>" class="btn">add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Link the product title to the view page -->
                                <a title="<?= h($product->name) ?>" href="<?= $this->App->appUrl(['action' => 'customerView', $product->id]) ?>" class="product-title">
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

    <?= $this->Html->script('filter_utils.js') ?>
    <script>
        // Initialize the sort dropdown
        initializeSortDropdown('sort-button', 'sort-options');

        // Initialize the filter fields
        const filterFields = ['product_name', 'price_range', 'categories', 'use_custom_range', 'min_price', 'max_price'];

        // Initialize the filter sidebar
        initializeFilterSidebar('filters-button', 'filter-sidebar', 'form', filterFields);
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
