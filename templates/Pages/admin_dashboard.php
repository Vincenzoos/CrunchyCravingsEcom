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
    <?= $this->Html->css(['utilities','form']) ?>

</head>

<div class="admin-dashboard">    
    <!-- Heading Section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-6 text-center">Admin Dashboard</h1>
            <p class="lead">Welcome to the Crunchy Cravings Admin Portal</p>
        </div>
    </section>
    
    <!-- Dashboard Cards -->
    <div class="container">
        <div class="row g-4">
            <!-- Manage Enquiries Card -->
            <div class="col-md-6 col-lg-4">
                <a href="<?= $this->App->appUrl(['controller' => 'Contacts', 'action' => 'index'])?>" class="dashboard-card">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h3 class="card-title">Enquiries</h3>
                            <p class="card-text">View and manage customer enquiries and contact messages</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Manage Products Card -->
            <div class="col-md-6 col-lg-4">
                <a href="<?= $this->App->appUrl(['controller' => 'Products', 'action' => 'index']) ?>" class="dashboard-card">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-cookie"></i>
                            </div>
                            <h3 class="card-title">Products</h3>
                            <p class="card-text">Add, edit, and manage your product inventory and details</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Manage Categories Card -->
            <div class="col-md-6 col-lg-4">
                <a href="<?= $this->App->appUrl(['controller' => 'Categories', 'action' => 'index']) ?>" class="dashboard-card">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <h3 class="card-title">Categories</h3>
                            <p class="card-text">Organize your products with custom categories and tags</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Manage Users Card -->
            <div class="col-md-6 col-lg-4">
                <a href="<?= $this->App->appUrl(['controller' => 'Users', 'action' => 'index']) ?>" class="dashboard-card">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="card-title">Users</h3>
                            <p class="card-text">Manage user accounts, permissions, and customer profiles</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Manage FAQs Card -->
            <div class="col-md-6 col-lg-4">
                <a href="<?= $this->App->appUrl(['controller' => 'Faqs', 'action' => 'index']) ?>" class="dashboard-card">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <h3 class="card-title">FAQs</h3>
                            <p class="card-text">Create and update frequently asked questions and answers</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Manage Orders Card -->
            <div class="col-md-6 col-lg-4">
                <a href="<?= $this->App->appUrl(['controller' => 'Orders', 'action' => 'index']) ?>" class="dashboard-card">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h3 class="card-title">Orders</h3>
                            <p class="card-text">Track, process, and manage customer orders and shipments</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Manage Content Card -->
            <div class="col-md-6 col-lg-4">
                <a href="<?= $this->Url->build(['plugin' => 'ContentBlocks','controller' => 'ContentBlocks', 'action' => 'index']) ?>" class="dashboard-card">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <h3 class="card-title">Content Blocks</h3>
                            <p class="card-text">Edit website content, banners, and promotional materials</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Add this CSS section in the file or include it in your CSS file -->
<style>
    .admin-dashboard {
        padding: 2rem 0;
    }
    
    .dashboard-header {
        padding: 2rem 0;
    }
    
    .dashboard-header h1 {
        color: #333;
        margin-bottom: 1rem;
    }
    
    .dashboard-card {
        display: block;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
    }
    
    .dashboard-card:hover {
        transform: translateY(-10px);
        text-decoration: none;
        color: inherit;
    }
    
    .dashboard-card .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .dashboard-card:hover .card {
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }
    
    .card-icon {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        color: #28a745;
        transition: all 0.3s ease;
    }
    
    .dashboard-card:hover .card-icon {
        transform: scale(1.2);
    }
    
    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .card-text {
        color: #6c757d;
    }
    
    @media (max-width: 768px) {
        .dashboard-header h1 {
            font-size: 2rem;
        }
    }
</style>

<!-- Make sure you have Font Awesome included in your layout -->
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>