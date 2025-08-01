<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

use Cake\View\Helper\HtmlHelper;
use Cake\View\View;
$html = new HtmlHelper(new View());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->Html->charset() ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $this->fetch('title') ?> - CrunchyCravings</title>

    <link rel="icon" type="image/png" href="<?= $this->Url->image('logo.png') ?>">

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Custom CSS, JS -->
    <?= $this->Html->css(['/vendor/fontawesome-free/css/all.min.css','style','default.css', 'flash.message']) ?>


    <?= $this->Html->meta('icon', 'img/favicon.png', ['type' => 'icon']) ?>
    <?= $this->Html->css([
        '/libraries/bootstrap/bootstrap.min.css',
        '/libraries/fuelux/jquery-ui.min.css',
        '/libraries/owl-carousel/owl.carousel.min.css',
        '/libraries/owl-carousel/owl.theme.default.min.css',
        '/libraries/fonts/font-awesome.min.css',
        '/libraries/animate/animate.min.css',
        '/libraries/flexslider/flexslider.css',
        '/libraries/magnific-popup.css',
        '/css/components.css',
        '/css/style.css',
        '/css/media.css',
        '/css/color-schemes/default.css',
    ]) ?>


    <link href='http://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic' rel='stylesheet'
        type='text/css'>
    <link
        href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,400italic,300italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <link
        href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <link
        href='http://fonts.googleapis.com/css?family=Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>

    <?= $this->fetch('css') ?>
    <?= $this->fetch('meta') ?>
</head>

<body id="page-top">

    <!-- LOADER -->
    <div id="site-loader" class="load-complete">
        <div class="load-position">
            <div class="logo"><?= $html->image('logo.png', ['alt' => 'logo']) ?></div>
            <h6>Please wait, loading...</h6>
            <div class="loading">
                <div class="loading-line"></div>
                <div class="loading-break loading-dot-1"></div>
                <div class="loading-break loading-dot-2"></div>
                <div class="loading-break loading-dot-3"></div>
            </div>
        </div>
    </div>
    <!-- Loader /- -->

    <!-- Accessibility Mode Toggle -->
    <div id="accessibility-toggle" class="accessibility-toggle">
        <button id="accessibility-button" class="btn btn-secondary">
            <i class="fa fa-gear fa-spin"></i>
        </button>
        <div id="accessibility-options" class="accessibility-options">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="accessibility-mode">
                <label class="form-check-label" for="accessibility-mode">
                    Enable Accessibility Mode
                </label>
                <p class="small text mt-1">Switch to a more accessible color scheme for better readability.</p>
            </div>
        </div>
    </div>

    <!-- Admin sidebar menu -->
    <?php if ($this->Identity->get('role') == 'admin') : ?>
        <!-- Sidebar Toggle Button -->
        <button id="sidebarToggle" class="btn btn-primary sidebar-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
            <div class="offcanvas-header">
                <h2 class="offcanvas-title" id="sidebarLabel">Admin Menu</h2>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="list-group">
                    <li><a href="<?= $this->App->appUrl(['controller' => 'Contacts', 'action' => 'index'])?>" class="list-group-item">Manage Enquiries</a></li>
                    <li><a href="<?= $this->App->appUrl(['controller' => 'Products', 'action' => 'index']) ?>" class="list-group-item">Manage Products</a></li>
                    <li><a href="<?= $this->App->appUrl(['controller' => 'Categories', 'action' => 'index']) ?>" class="list-group-item">Manage Categories</a></li>
                    <li><a href="<?= $this->App->appUrl(['controller' => 'Users', 'action' => 'index']) ?>" class="list-group-item">Manage Users</a></li>
                    <li><a href="<?= $this->App->appUrl(['controller' => 'Faqs', 'action' => 'index']) ?>" class="list-group-item">Manage FAQs</a></li>
                    <li><a href="<?= $this->App->appUrl(['controller' => 'Orders', 'action' => 'index']) ?>" class="list-group-item">Manage Orders</a></li>
                    <li><a href="<?= $this->Url->build(['plugin' => 'ContentBlocks','controller' => 'ContentBlocks', 'action' => 'index']) ?>" class="list-group-item">Manage Contents</a></li>
                    <li><a href="<?= $this->App->appUrl(['controller' => 'Pages', 'action' => 'admin_dashboard']) ?>" class="list-group-item">Admin Dashboard</a></li>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <!-- Header Section -->
    <header id="header" class="header">
        <!-- logo-search-block -->
        <div class="logo-search-block">
            <!-- container -->
            <div class="container">
                <div class="row" style="display: flex; justify-content: center; align-items: center;">
                    <!-- Spacing -->
                    <div class="col-0 col-md-0 col-lg-3"></div>

                    <!-- Logo -->
                    <div class="col-6 col-md-6 col-lg-6 logo-block">
                        <a title="Logo" href="<?= $this->App->appUrl(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">
                            <!-- Test replace logo using content blocks                            -->
                            <?= $this->ContentBlock->image('logo'); ?>
<!--                            --><?php //= $html->image('cc_logo.png', ['alt' => 'add-banner', 'style' => 'width: 80%; height: auto; margin-top: 15px; margin-bottom: 15px;']) ?>
                        </a>
                    </div>
                    <div class="col-3 col-md-3 col-lg-2 d-flex justify-content-lg-end">
                        <div class="row cart-link" style="display: flex; justify-content: space-between; align-items: center;">
                            <!-- Cart Link with Count -->
                            <a title="Cart" id="top_link" href="<?= $this->App->appUrl(['controller' => 'CartItems', 'action' => 'customerView']) ?>">
                                <svg width="26px" height="25px" viewBox="0 0 533.334 533.335" style="width: 26px; height: 25px;">
                                    <g>
                                        <path
                                            d="M441.26,300.001c18.333,0,37.454-14.423,42.49-32.052l48.353-169.231c5.036-17.627-5.844-32.05-24.177-32.05H166.667   c0-36.819-29.848-66.667-66.667-66.667H0v66.667h100v283.333c0,27.614,22.386,50,50,50h316.667   c18.409,0,33.334-14.924,33.334-33.333s-14.925-33.334-33.334-33.334h-300v-33.333H441.26z M166.667,133.334h301.461l-28.573,100   H166.667V133.334z M200,491.668c0,22.916-18.75,41.666-41.667,41.666h-16.667c-22.917,0-41.667-18.75-41.667-41.666v-16.667   c0-22.917,18.75-41.667,41.667-41.667h16.667c22.917,0,41.667,18.75,41.667,41.667V491.668z M500,491.668   c0,22.916-18.75,41.666-41.667,41.666h-16.667c-22.916,0-41.666-18.75-41.666-41.666v-16.667c0-22.917,18.75-41.667,41.666-41.667   h16.667c22.917,0,41.667,18.75,41.667,41.667V491.668z" />
                                    </g>
                                </svg>
                                (<span id="cart-count"><?= h($cartCount) ?></span>)
                            </a>
                        </div>
                    </div>

                    <!-- Determine whether to show login or logout, and save the current page in URL redirect to be used as a fallback -->
                    <?php if ($this->Identity->isLoggedIn()) : ?>
                        <div class="col-1 col-md-1 col-lg-1 d-flex justify-content-end">
                            <?php
                                // Get the user's email and extract the first two letters
                                $userEmail = $this->Identity->get('email');
                                $initials = strtoupper(substr($userEmail, 0, 1));
                            ?>
                            <!-- Dropdown Menu -->
                            <div id="profile-dropdown" class="profile-dropdown text-center" style="display: relative;">
                                <!-- Button -->
                                <button id="profile-toggle" class="btn btn-secondary rounded-circle">
                                    <?= $initials ?>
                                </button>

                                <!-- Content -->
                                <ul id="profile-content">
                                    <li><a id="profile-email"><?= h($this->Identity->get('email')) ?></a></li>
                                    <li><hr class="dropdown-divider" style="margin-top: 1.0rem; margin-bottom: 0.5rem;"></li>
                                    <!-- <li><a class="dropdown-item" href="<?= $this->App->appUrl(['controller' => 'Orders', 'action' => 'orders']) ?>">Orders</a></li> -->
                                    <li><a class="dropdown-item" href="<?= $this->App->appUrl(['controller' => 'Auth', 'action' => 'logout']) ?>">Logout</a></li>
                                    <li><a class="dropdown-item" href="<?= $this->App->appUrl(['controller' => 'Auth', 'action' => 'changePassword', $this->Identity->get('id')]) ?>">Change Password</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="col-1 col-md-1 col-lg-1 align-items-center" style="margin-top: 15px; margin-bottom: 15px;">
                            <a title="Login"
                                id="top_link"

                                href="<?= $this->App->appUrl(['controller' => 'Auth','action' => 'login','?' => ['redirect' => $this->request->getRequestTarget()]]) ?>" class="list-group-item">
                                LOGIN
                            </a>

                            <a title="Register"
                                id="top_link"

                                href="<?= $this->App->appUrl(['controller' => 'Auth', 'action' => 'register']) ?>">
                                REGISTER
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Spacing for mobile only -->
                    <div class="col-2 col-md-2 col-lg-0"></div>
                </div>
            </div><!-- container /- -->
        </div><!-- logo-add-block /- -->

        <!-- menu-block -->
        <div class="menu-block">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-static-top">
                    <div class="navbar-header">
                        <a href="<?= $this->App->appUrl(['controller' => 'Pages', 'action' => 'display']) ?>" class="logo"><?= $html->image('logo.png', ['alt' => 'logo']) ?></a>
                        <button class="navbar-toggler" type="button" id="custom-toggler" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"><a class="nav-link active" title="Home" href="<?= $this->App->appUrl(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                            <li class="nav-item"><a class="nav-link" title="Products" href="<?= $this->App->appUrl(['controller' => 'Products', 'action' => 'customerIndex']) ?>">Products</a></li>
                            <li class="nav-item"><a title="categories" href="<?= $this->App->appUrl(['controller' => 'Categories', 'action' => 'customerIndex']) ?>" class="nav-link">categories</a></li>
                            <li class="nav-item"><a class="nav-link" title="Contact us" href="<?= $this->App->appUrl(['controller' => 'Contacts', 'action' => 'contactUs']) ?>">Contact us</a></li>
                            <li class="nav-item"><a class="nav-link" title="FAQ" href="<?= $this->App->appUrl(['controller' => 'Faqs', 'action' => 'customerIndex']) ?>">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link" title="Order Lookup" href="<?= $this->App->appUrl(['controller' => 'Orders', 'action' => 'orders']) ?>">Orders</a></li>
                            <!-- Admin dashboard -->
                            <?php if ($this->Identity->get('role') == 'admin') : ?>
                                <li class="nav-item">
                                    <a class="nav-link" title="Admin Dashboard" href="<?= $this->App->appUrl(['controller' => 'Pages', 'action' => 'admin_dashboard']) ?>">
                                        Admin Dashboard
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- Header Section /- -->

    <div id="page-content" class="d-flex flex-column"> <!--  min-vh-100 -->
        <!-- Main Content -->
        <!-- <div class="flex-grow-1"> -->
            <div id="main-content" class="container-fluid">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        <!-- </div> -->
    </div>

    <!-- Footer Section -->
    <div id="footer-section" class="footer-section">

        <!-- <div id="add-banner-section" class="add-banner-section bottom-shadow">
            <div class="container" style="display: flex; justify-content: center; align-items: center; height: 100%; text-align: center;">
                <a title="Logo" href="<?= $this->App->appUrl(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">
                    <?= $html->image('cc_logo.png', ['alt' => 'add-banner', 'style' => 'width: 25%; height: auto; margin-top: 15px; margin-bottom: 0px;']) ?>
                </a>
            </div>
        </div> -->

        <!-- widget section -->
        <!--        TODO: Need to recenter footer since unusable links commented out -->
        <div class="widget-section bottom-shadow">
            <!-- container -->
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center">
                    <!-- widget about -->
                    <aside class="col-12 col-md-12 col-lg-4 widget widget_about d-flex justify-content-around">
                        <div class="address col-md-6">
                            <svg viewBox="0 0 512 512">
                                <path
                                    d="M192,307.188V160l128-96v227.5c-6.281,0.656-12.938,1.344-20.094,2.062c-27.969,2.813-62.781,6.313-107.281,13.531   L192,307.188z M488.344,145.813L352,64v223.125C406.281,277.188,426.531,253.375,488.344,145.813z M352,319.312V416l160,96V168.719   C445.719,282.938,421,307.906,352,319.312z M21.594,428.938L160,512V344.719C112.031,353.188,66.031,368,21.594,428.938z    M303.094,325.406c-27.531,2.781-61.813,6.219-105.344,13.25l-5.75,0.906V512l128-96v-92.375   C314.531,324.219,309.062,324.812,303.094,325.406z M80,144c-5.469,0-10.813-0.563-16-1.625V256l32-16v-97.625   C90.813,143.438,85.469,144,80,144z M80,0C44.656,0,16,28.625,16,64s28.656,64,64,64c35.375,0,64-28.625,64-64S115.375,0,80,0z    M64,80c-17.688,0-32-14.313-32-32s14.313-32,32-32s32,14.313,32,32S81.688,80,64,80z M128,146.656v113.125l-96,48V146.656   c-12.875-7.531-23.781-18-32-30.344v288.156C52.25,336.25,108.219,321,160,312.25V160l-27.375-16.438   C131.063,144.594,129.625,145.719,128,146.656z" />
                            </svg>
                            <h4>CC Headquarters</h4>
                            <a style="color: #686868" href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($this->ContentBlock->text('business-address')); ?>">
                                <?= $this->ContentBlock->text('business-address'); ?>
                            </a>
                        </div>
                        <div class="helpline  col-md-6">
                            <svg viewBox="0 0 51.413 51.413">
                            </svg>
                            <h4>Help Lines</h4>
                            <a class="text-nowrap" href="tel:<?= $this->ContentBlock->text('business-phone'); ?>"><?= $this->ContentBlock->text('business-phone'); ?></a>
                            <a class="text-nowrap" href="mailto:<?= $this->ContentBlock->text('business-email'); ?>"><?= $this->ContentBlock->text('business-email'); ?></a>
                        </div>
                    </aside><!-- widget about /- -->
                </div>
            </div>
            <!-- container /- -->
        </div>
        <!-- widget section /- -->

        <!-- Phone logo saved -->
         <!-- <path
                d="M25.989,12.274c8.663,0.085,14.09-0.454,14.823,9.148h10.564c0-14.875-12.973-16.88-25.662-16.88    c-12.69,0-25.662,2.005-25.662,16.88h10.482C11.345,11.637,17.398,12.19,25.989,12.274z" />
            <path
                d="M5.291,26.204c2.573,0,4.714,0.154,5.19-2.377c0.064-0.344,0.101-0.734,0.101-1.185H10.46H0    C0,26.407,2.369,26.204,5.291,26.204z" />
            <path
                d="M40.88,22.642h-0.099c0,0.454,0.039,0.845,0.112,1.185c0.502,2.334,2.64,2.189,5.204,2.189    c2.936,0,5.316,0.193,5.316-3.374H40.88z" />
            <path
                d="M35.719,20.078v-1.496c0-0.669-0.771-0.711-1.723-0.711h-1.555c-0.951,0-1.722,0.042-1.722,0.711    v1.289v1h-11v-1v-1.289c0-0.669-0.771-0.711-1.722-0.711h-1.556c-0.951,0-1.722,0.042-1.722,0.711v1.496v1.306    C12.213,23.988,4.013,35.073,3.715,36.415l0.004,8.955c0,0.827,0.673,1.5,1.5,1.5h40c0.827,0,1.5-0.673,1.5-1.5v-9    c-0.295-1.303-8.493-12.383-11-14.987V20.078z M19.177,37.62c-0.805,0-1.458-0.652-1.458-1.458s0.653-1.458,1.458-1.458    s1.458,0.652,1.458,1.458S19.982,37.62,19.177,37.62z M19.177,32.62c-0.805,0-1.458-0.652-1.458-1.458s0.653-1.458,1.458-1.458    s1.458,0.652,1.458,1.458S19.982,32.62,19.177,32.62z M19.177,27.621c-0.805,0-1.458-0.652-1.458-1.458    c0-0.805,0.653-1.458,1.458-1.458s1.458,0.653,1.458,1.458C20.635,26.969,19.982,27.621,19.177,27.621z M25.177,37.62    c-0.805,0-1.458-0.652-1.458-1.458s0.653-1.458,1.458-1.458c0.806,0,1.458,0.652,1.458,1.458S25.983,37.62,25.177,37.62z     M25.177,32.62c-0.805,0-1.458-0.652-1.458-1.458s0.653-1.458,1.458-1.458c0.806,0,1.458,0.652,1.458,1.458    S25.983,32.62,25.177,32.62z M25.177,27.621c-0.805,0-1.458-0.652-1.458-1.458c0-0.805,0.653-1.458,1.458-1.458    c0.806,0,1.458,0.653,1.458,1.458C26.635,26.969,25.983,27.621,25.177,27.621z M31.177,37.62c-0.806,0-1.458-0.652-1.458-1.458    s0.652-1.458,1.458-1.458s1.458,0.652,1.458,1.458S31.983,37.62,31.177,37.62z M31.177,32.62c-0.806,0-1.458-0.652-1.458-1.458    s0.652-1.458,1.458-1.458s1.458,0.652,1.458,1.458S31.983,32.62,31.177,32.62z M31.177,27.621c-0.806,0-1.458-0.652-1.458-1.458    c0-0.805,0.652-1.458,1.458-1.458s1.458,0.653,1.458,1.458C32.635,26.969,31.983,27.621,31.177,27.621z" /> -->

        <!-- Old footer sections saved (will need after order system implemented) -->
        <!--                            <aside class="col-12  col-sm-4 col-md-4 col-lg-4 widget widget_list_style">-->
        <!--                                <h3 class="widget-title">-->
        <!--                                    Our Stores-->
        <!--                                </h3>-->
        <!--                                <ul>-->
        <!--                                    <li><a title="Melbourne" href="">Melbourne</a></li>-->
        <!--                                    <li><a title="Sydney" href="">Sydney</a></li>-->
        <!--                                    <li><a title="Brisbane" href="">Brisbane</a></li>-->
        <!--                                    <li><a title="Perth" href="">Perth</a></li>-->
        <!--                                </ul>-->
        <!--                            </aside>-->


        <!--                            <aside class="col-12 col-sm-4 col-md-4 col-lg-4 widget widget_list_style">-->
        <!--                                <h3 class="widget-title">-->
        <!--                                    Orders-->
        <!--                                </h3>-->
        <!--                                <ul>-->
        <!--                                    <li><a title="Order Status" href="">Order Status</a></li>-->
        <!--                                    <li><a title="My Order History" href="">My Order History</a></li>-->
        <!--                                    <li><a title="Payments" href="">Payments</a></li>-->
        <!--                                    <li><a title="Returns" href="">Returns</a></li>-->
        <!--                                </ul>-->
        <!--                            </aside>-->
        <!-- Footer bottom -->
        <div class="footer-bottom">
            <!-- container -->
            <div class="container">
                <div class="row" style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-12 col-md-12 col-lg-3">
<!--                        <a title="Payment-getway" href="">--><?php //= $html->image('footer/payment-getway-icon.png', ['alt' => 'payment-icon']) ?><!--</a>-->
                    </div>
                </div>
            </div>
            <!-- container /- -->
            <a title="Back-to-top" id="back-to-top" href="#back-to-top" class="back-to-top"><i class="fa fa-caret-up"></i></a>
        </div>
        <!-- Footer Bottom -->

        <!-- Copyright -->
        <footer class="footer" id="footer">
            <div class="copyright">
                <?= $this->ContentBlock->html('copyright-message'); ?>
            </div>
        </footer>
    </div><!-- Footer Section /- -->

    <!-- Script to handle sidebar toggle mode -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebarToggle');

            // Only proceed if the sidebar element exists
            if (sidebar) {
                // Listen for the sidebar's show and hide events
                sidebar.addEventListener('show.bs.offcanvas', function () {
                    console.log('Sidebar shown');
                    toggleButton.style.display = 'none';
                });
                sidebar.addEventListener('hide.bs.offcanvas', function () {
                    console.log('Sidebar closed');
                    toggleButton.style.display = 'block';
                });

                // Detect clicks on the offcanvas backdrop
                document.addEventListener('click', function (event) {
                const backdrop = document.querySelector('.offcanvas-backdrop');
                    if (backdrop && backdrop.contains(event.target)) {
                        toggleButton.style.display = 'block';
                    }
                });
            }
        });
    </script>

    <!-- Accessibility Mode Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleContainer = document.getElementById('accessibility-toggle');
            const toggleButton = document.getElementById('accessibility-button');
            const options = document.getElementById('accessibility-options');
            const accessibilityCheckbox = document.getElementById('accessibility-mode');

            // Toggle the visibility of the accessibility options
            toggleButton.addEventListener('click', function () {
                toggleContainer.classList.toggle('open');
            });

            // Function to apply accessibility mode
            function applyAccessibilityMode(isEnabled) {
                if (isEnabled) {
                    // default.css Accessibility mode
                    document.documentElement.style.setProperty('--sidebar-text-color', 'var(--accessible-sidebar-text-color)');
                    document.documentElement.style.setProperty('--sidebar-bg-color', 'var(--accessible-sidebar-bg-color)');
                    document.documentElement.style.setProperty('--sidebar-hover-color', 'var(--accessible-sidebar-hover-color)');
                    document.documentElement.style.setProperty('--border-color', 'var(--accessible-border-color)');
                    document.documentElement.style.setProperty('--background-color', 'var(--accessible-background-color)');
                    document.documentElement.style.setProperty('--text-color', 'var(--accessible-text-color)');
                    document.documentElement.style.setProperty('--button-text-color', 'var(--accessible-button-text-color)');
                    document.documentElement.style.setProperty('--empty-color', 'var(--accessible-empty-color)');
                    document.documentElement.style.setProperty('--icon-color', 'var(--accessible-icon-color)');
                    document.documentElement.style.setProperty('--icon-hover-color', 'var(--accessible-icon-hover-color)');
                    document.documentElement.style.setProperty('--paginator-color', 'var(--accessible-paginator-color)');
                    document.documentElement.style.setProperty('--paginator-hover-color', 'var(--accessible-paginator-hover-color)');

                    // style.css Accessibility mode
                    document.documentElement.style.setProperty('--fade-text-col', 'var(--accessible-fade-text-col)');
                    document.documentElement.style.setProperty('--fade2-text-col', 'var(--accessible-fade2-text-col)');
                    document.documentElement.style.setProperty('--heading-text-col', 'var(--accessible-heading-text-col)');
                    document.documentElement.style.setProperty('--text-col', 'var(--accessible-text-col)');
                    document.documentElement.style.setProperty('--col1', 'var(--accessible-col1)');
                    document.documentElement.style.setProperty('--col2', 'var(--accessible-col2)');
                    document.documentElement.style.setProperty('--col3', 'var(--accessible-col3)');
                    document.documentElement.style.setProperty('--main-font', 'var(--accessible-main-font)');
                } else {
                    // default.css Default mode
                    document.documentElement.style.setProperty('--sidebar-text-color', 'var(--default-sidebar-text-color)');
                    document.documentElement.style.setProperty('--sidebar-bg-color', 'var(--default-sidebar-bg-color)');
                    document.documentElement.style.setProperty('--sidebar-hover-color', 'var(--default-sidebar-hover-color)');
                    document.documentElement.style.setProperty('--border-color', 'var(--default-border-color)');
                    document.documentElement.style.setProperty('--background-color', 'var(--default-background-color)');
                    document.documentElement.style.setProperty('--text-color', 'var(--default-text-color)');
                    document.documentElement.style.setProperty('--button-text-color', 'var(--default-button-text-color)');
                    document.documentElement.style.setProperty('--empty-color', 'var(--default-empty-color)');
                    document.documentElement.style.setProperty('--icon-color', 'var(--default-icon-color)');
                    document.documentElement.style.setProperty('--icon-hover-color', 'var(--default-icon-hover-color)');
                    document.documentElement.style.setProperty('--paginator-color', 'var(--default-paginator-color)'); /* Paginator color */
                    document.documentElement.style.setProperty('--paginator-hover-color', 'var(--default-paginator-hover-color)'); /* Paginator hover color */

                    // style.css Default mode
                    document.documentElement.style.setProperty('--fade-text-col', 'var(--default-fade-text-col)');
                    document.documentElement.style.setProperty('--fade2-text-col', 'var(--default-fade2-text-col)');
                    document.documentElement.style.setProperty('--heading-text-col', 'var(--default-heading-text-col)');
                    document.documentElement.style.setProperty('--text-col', 'var(--default-text-col)');
                    document.documentElement.style.setProperty('--col1', 'var(--default-col1)');
                    document.documentElement.style.setProperty('--col2', 'var(--default-col2)');
                    document.documentElement.style.setProperty('--col3', 'var(--default-col3)');
                    document.documentElement.style.setProperty('--main-font', 'var(--default-main-font)');
                }
            }

            // Load the saved accessibility setting from localStorage
            const savedAccessibilitySetting = localStorage.getItem('accessibility-mode');
            if (savedAccessibilitySetting === 'true') {
                accessibilityCheckbox.checked = true;
                applyAccessibilityMode(true);
            }

            // Listen for changes to the checkbox
            accessibilityCheckbox.addEventListener('change', function () {
                const isEnabled = this.checked;
                applyAccessibilityMode(isEnabled);

                // Save the setting to localStorage
                localStorage.setItem('accessibility-mode', isEnabled);
            });
        });
    </script>

    <!-- Profile Dropdown Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownMenu = document.getElementById('profile-dropdown');
            const toggleButton = document.getElementById('profile-toggle');
            const content = document.getElementById('profile-content');

            // Toggle the visibility of the accessibility options
            toggleButton.addEventListener('click', function (event) {
                event.stopPropagation(); // Prevent the click from propagating to the document
                content.classList.toggle('show'); // Toggle the 'show' class
            });

            // Close the dropdown if clicked outside
            document.addEventListener('click', function (event) {
                if (!toggleButton.contains(event.target) && !content.contains(event.target)) {
                    content.classList.remove('show');
                }
            });
        });
    </script>

    <!-- Fix navbar collapse issue -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggler = document.getElementById('custom-toggler');
            const navbarCollapse = document.getElementById('navbar');

            toggler.addEventListener('click', function () {
                const isShown = navbarCollapse.classList.contains('show');

                if (isShown) {
                    navbarCollapse.classList.remove('show');
                } else {
                    navbarCollapse.classList.add('show');
                }
            });
        });
    </script>

    <!-- Replace icon script to overide template  -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Remove all existing favicon links
            const existingIcons = document.querySelectorAll('link[rel="icon"], link[rel="shortcut icon"]');
            existingIcons.forEach(icon => icon.remove());

            // Add custom favicon
            const favicon = document.createElement('link');
            favicon.rel = 'icon';
            favicon.type = 'image/png';
            favicon.href = '<?= $this->Url->image('logo.png') ?>';
            document.head.appendChild(favicon);
        });
    </script>

    <!-- Select2 JS -->
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js') ?>

    <!-- jQuery Include -->
    <?= $html->script('/libraries/gmap/jquery.gmap.min.js') ?>
    <?= $html->script('/libraries/jquery.easing.min.js') ?>
    <?= $html->script('/libraries/fuelux/jquery-ui.min.js') ?>
    <?= $html->script('/libraries/jquery.animateNumber.min.js') ?>
    <?= $html->script('/libraries/jquery.appear.js') ?>
    <?= $html->script('/libraries/jquery.knob.js') ?>
    <?= $html->script('/libraries/wow.min.js') ?>
    <?= $html->script('/libraries/owl-carousel/owl.carousel.min.js') ?>
    <?= $html->script('/libraries/expanding-search/modernizr.custom.js') ?>
    <?= $html->script('/libraries/flexslider/jquery.flexslider-min.js') ?>
    <?= $html->script('/libraries/jquery.magnific-popup.min.js') ?>
    <!-- Customized Scripts -->
    <?= $html->script('/js/functions.js') ?>

    <?= $this->fetch('script') ?>
</body>

</html>
