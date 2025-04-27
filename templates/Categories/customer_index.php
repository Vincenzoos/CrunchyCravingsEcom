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
    <?= $this->Html->css(['utilities','shop','categories']) ?>

    <?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body data-offset="200" data-spy="scroll" data-target=".primary-navigation">
    <!-- Page Breadcrumb -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Categories" href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'customerIndex']) ?>">Categories</a></li>
            </ol>
        </div>
    </div>

    <!-- Admin Manage Categories button -->
    <?php if ($this->Identity->isLoggedIn() && $this->Identity->get('role') === 'admin') : ?>
        <div class="text-center mb-3">
            <a href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'index']) ?>" class="btn btn-danger">
                Manage Categories
            </a>
        </div>
    <?php endif; ?>

    <div id="shop-container" class="container my-5">
        <div class="row">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div id="shop-box" class="card">
                        <!-- Featured Product Image -->
                        <div class="card-img-top">
                            <?php if (!empty($category->products) && !empty($category->products[0]->image)): ?>
                                <?= $this->Html->image($category->products[0]->image_cache_busted_url, [
                                    'alt' => $category->name,
                                    'class' => 'img-fluid rounded',
                                    'style' => 'height: 100%; object-fit: cover; width: 100%;'
                                ]) ?>
                            <?php else: ?>
                                <?= $this->Html->image('default-category.jpg', [
                                    'alt' => $category->name,
                                    'class' => 'img-fluid rounded',
                                    'style' => 'height: 100%; object-fit: cover; width: 100%;'
                                ]) ?>
                            <?php endif; ?>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerIndex', '?' => ['category_id' => $category->id]]) ?>" class="text-decoration-none text-dark">
                                    <?= h($category->name) ?>
                                </a>
                            </h5>
                            <p class="card-text text-muted">
                                <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerIndex', '?' => ['category_id' => $category->id]]) ?>" class="text-decoration-none text-muted">
                                    <?= h($category->description) ?>
                                </a>
                            </p>
                            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerIndex', '?' => ['category_id' => $category->id]]) ?>" class="btn btn-primary">
                                View Products
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>
