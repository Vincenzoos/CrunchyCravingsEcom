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
            <div class="product-filter-box bottom-shadow">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div id="slider-range"></div>
                        <div class="price-input">
                            <label>or </label>
                            <input type="text" id="min-price" readonly>
                            <label>to </label>
                            <input type="text" id="max-price" readonly>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-8 no-padding">
                        <form>
                            <!-- <div class="row">
                                <div class="col-12 col-md-12 col-lg-4  no-padding">
                                    <div class="product-search-option">
                                        <div class="from-group">
                                            <select class="form-control minimal">
                                                <option value="selected">Categories</option>
                                                <option value="">1</option>
                                                <option value="">2</option>
                                                <option value="">3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- Categories -->
                            <div class="col-12 col-md-6 col-lg-6">
                                <h4>Filter by Categories</h4>
                                <div class="category-checkboxes">
                                    <?php foreach ($categories as $category) : ?>
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="categories[]"
                                                value="<?= h($category->id) ?>"
                                                id="category-<?= h($category->id) ?>">
                                            <label class="form-check-label" for="category-<?= h($category->id) ?>">
                                                <?= h($category->name) ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Filter /- -->

    <!-- Feature Product -->
    <!-- <div id="featured-products" class="featured-products bottom-shadow">
        <div class="container">
            <div class="category-box-main product-box-main">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 main-product">
                        <div class="category-box product-box">
                            <span class="sale">sales</span>
                            <div class="inner-product">
                                <img src="images/featured/featured-1.jpg" alt="featured-img" />
                                <div class="product-box-inner">
                                    <ul>
                                        <li><a title="Eye Icon" href="images/featured/featured-1.jpg"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a title="Heart Icon" href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                    <a title="Add to cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <a title="Fashionable Pink Top" href="#" class="product-title">Bodycon Dress</a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount"><del>&dollar;24.99</del> &dollar;19.99</span>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3  main-product">
                        <div class="category-box product-box">
                            <div class="inner-product">
                                <img src="images/featured/featured-2.jpg" alt="featured-img" />
                                <div class="product-box-inner">
                                    <ul>
                                        <li><a title="Eye Icon" href="images/featured/featured-2.jpg"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a title="Heart Icon" href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                    <a title="Add to cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <a title="Fashionable Pink Top" href="#" class="product-title">Fashionable Dress</a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount"><del>&dollar;24.99</del> &dollar;19.99</span>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 main-product">
                        <div class="category-box product-box">
                            <span class="sale">sales</span>
                            <div class="inner-product">
                                <img src="images/featured/featured-3.jpg" alt="featured-img" />
                                <div class="product-box-inner">
                                    <ul>
                                        <li><a title="Eye Icon" href="images/featured/featured-3.jpg"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a title="Heart Icon" href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                    <a title="Add to cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <a title="Fashionable Pink Top" href="#" class="product-title">Strapless Dress</a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount"><del>&dollar;24.99</del> &dollar;19.99</span>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 main-product">
                        <div class="category-box product-box">
                            <div class="inner-product">
                                <img src="images/featured/featured-4.jpg" alt="featured-img" />
                                <div class="product-box-inner">
                                    <ul>
                                        <li><a title="" href="images/featured/featured-4.jpg"><i
                                                    class="fa fa-eye"></i></a>
                                        </li>
                                        <li><a title="" href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                    <a title="Add to cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <a title="Fashionable Pink Top" href="#" class="product-title">Strapless Dress</a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount"><del>&dollar;24.99</del> &dollar;19.99</span>
                    </div>
                </div>
            </div>

            <div class="category-box-main product-box-main">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 main-product">
                        <div class="category-box product-box">
                            <span class="sale">sales</span>
                            <div class="inner-product">
                                <img src="images/featured/featured-5.jpg" alt="featured-img" />
                                <div class="product-box-inner">
                                    <ul>
                                        <li><a title="Eye Icon" href="images/featured/featured-5.jpg"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a title="Heart Icon" href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                    <a title="Add to cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <a title="Fashionable Pink Top" href="#" class="product-title">Empire Waist Dress</a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount"><del>&dollar;24.99</del> &dollar;19.99</span>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 main-product">
                        <div class="category-box product-box">
                            <div class="inner-product">
                                <img src="images/featured/featured-6.jpg" alt="featured-img" />
                                <div class="product-box-inner">
                                    <ul>
                                        <li><a title="Eye Icon" href="images/featured/featured-6.jpg"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a title="Heart Icon" href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                    <a title="Add to cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <a title="Fashionable Pink Top" href="#" class="product-title">Skater Dress</a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount"><del>&dollar;24.99</del> &dollar;19.99</span>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 main-product">
                        <div class="category-box product-box">
                            <span class="sale">sales</span>
                            <div class="inner-product">
                                <img src="images/featured/featured-7.jpg" alt="featured-img" />
                                <div class="product-box-inner">
                                    <ul>
                                        <li><a title="Eye Icon" href="images/featured/featured-7.jpg"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a title="Heart Icon" href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                    <a title="Add to cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <a title="Fashionable Pink Top" href="#" class="product-title">Backless Dress</a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount"><del>&dollar;24.99</del> &dollar;19.99</span>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 main-product">
                        <div class="category-box product-box">
                            <div class="inner-product">
                                <img src="images/featured/featured-8.jpg" alt="featured-img" />
                                <div class="product-box-inner">
                                    <ul>
                                        <li><a title="Eye Icon" href="images/featured/featured-8.jpg"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a title="Heart ICon" href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                    <a title="Add to cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <a title="Fashionable Pink Top" href="#" class="product-title">A-line Dress</a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount"><del>&dollar;24.99</del> &dollar;19.99</span>
                    </div>
                </div>
            </div>

            <div class="category-box-main product-box-main new-categories">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 main-product">
                        <div class="category-box product-box">
                            <span class="sale">sales</span>
                            <div class="inner-product">
                                <img src="images/featured/featured-1.jpg" alt="featured-img" />
                                <div class="product-box-inner">
                                    <ul>
                                        <li><a title="Eye Icon" href="images/featured/featured-1.jpg"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a title="Heart Icon" href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                    <a title="Add to cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <a title="Fashionable Pink Top" href="#" class="product-title">Cape Dress</a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount"><del>&dollar;24.99</del> &dollar;19.99</span>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 main-product">
                        <div class="category-box product-box">
                            <div class="inner-product">
                                <img src="images/featured/featured-2.jpg" alt="featured-img" />
                                <div class="product-box-inner">
                                    <ul>
                                        <li><a title="Eye Icon" href="images/featured/featured-2.jpg"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a title="Heart Icon" href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                    <a title="Add to cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <a title="Fashionable Pink Top" href="#" class="product-title">Leather Dress</a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount"><del>&dollar;24.99</del> &dollar;19.99</span>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 main-product">
                        <div class="category-box product-box">
                            <span class="sale">sales</span>
                            <div class="inner-product">
                                <img src="images/featured/featured-3.jpg" alt="featured-img" />
                                <div class="product-box-inner">
                                    <ul>
                                        <li><a title="Eye" href="images/featured/featured-3.jpg"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a title="Heart" href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                    <a title="Add to cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <a title="Fashionable Pink Top" href="#" class="product-title">Tube/Bandeau Dress</a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount"><del>&dollar;24.99</del> &dollar;19.99</span>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 main-product">
                        <div class="category-box product-box">
                            <div class="inner-product">
                                <img src="images/featured/featured-4.jpg" alt="featured-img" />
                                <div class="product-box-inner">
                                    <ul>
                                        <li><a title="Eye" href="images/featured/featured-4.jpg"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a title="Heart" href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                    <a title="Add to cart" href="#" class="btn">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <a title="Fashionable Pink Top" href="#" class="product-title">Sheath Dress</a>
                        <ul class="star">
                            <li>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <span class="amount"><del>&dollar;24.99</del> &dollar;19.99</span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Feature Product /- -->

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

    <!-- Debug show products table -->
    <div class="products index content">
        <h1>Debug products table</h1>
        <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'button float-right']) ?>
        <h3><?= __('Products') ?></h3>

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
                <?= $this->Form->button(__('Filter'), ['class' => 'btn btn-primary w-100']) ?>
            </div>

            <?= $this->Form->end() ?>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('name') ?></th>
                        <th><?= $this->Paginator->sort('price') ?></th>
                        <th><?= $this->Paginator->sort('image') ?></th>
                        <th><?= $this->Paginator->sort('quantity') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= h($product->name) ?></td>
                        <td><?= $this->Number->currency($product->price, 'AUD', ['places' => 2]) ?></td>
                        <td><?= empty($product->image) === true ? 'None' : h($product->image) ?></td>
                        <td><?= $product->quantity === null ? 0 : $this->Number->format($product->quantity) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $product->id],
                                [
                                    'method' => 'delete',
                                    'confirm' => __('Are you sure you want to delete this product: "{0}"?', $product->name),
                                ],
                            ) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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

    <!-- Filter scripts -->
    <script>
        $(document).ready(function () {
            // Function to fetch and update products dynamically
            function fetchFilteredProducts() {
                // Get selected categories
                let selectedCategories = [];
                $('.category-checkboxes input[type="checkbox"]:checked').each(function () {
                    selectedCategories.push($(this).val());
                });

                // Get price range
                let minPrice = $("#min-price").val();
                let maxPrice = $("#max-price").val();

                // Make an AJAX request to fetch filtered products
                $.ajax({
                    url: "<?= $this->Url->build(['action' => 'index']) ?>", // Adjust URL if needed
                    method: "GET",
                    data: {
                        categories: selectedCategories,
                        min_price: minPrice,
                        max_price: maxPrice
                    },
                    success: function (response) {
                        // Replace the product list with the filtered products
                        $("#featured-products .row").html(response);
                        // console.log(response)
                    },
                    error: function () {
                        console.error("Failed to fetch filtered products.");
                    }
                });
            }

            // Initialize the price slider
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 1000, // Adjust this max value based on your product price range
                values: [0, 1000],
                slide: function (event, ui) {
                    $("#min-price").val(ui.values[0]);
                    $("#max-price").val(ui.values[1]);

                    // Fetch products dynamically when the slider is adjusted
                    fetchFilteredProducts();
                }
            });

            // Set initial values for the price inputs
            $("#min-price").val($("#slider-range").slider("values", 0));
            $("#max-price").val($("#slider-range").slider("values", 1));

            // Fetch products dynamically when a category checkbox is clicked
            $('.category-checkboxes input[type="checkbox"]').on('change', function () {
                fetchFilteredProducts();
            });
        });
    </script>

    <!-- Customized Scripts -->
    <script src="js/functions.js"></script>


</body>

</html>
