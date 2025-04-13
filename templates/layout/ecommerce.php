<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\View\Helper\HtmlHelper;
use Cake\View\View;

$this->extend('default'); // Extend the default layout
?>
<?php
$html = new HtmlHelper(new View());
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

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Crunchy Cravings <?= $this->fetch('title') ?></title>

    <?= $this->Html->meta('icon', 'images/favicon.png', ['type' => 'icon']) ?>
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

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5/html5shiv.min.js"></script>
      <script src="js/html5/respond.min.js"></script>
    <![endif]-->

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

</head>

<body data-offset="200" data-spy="scroll" data-target=".primary-navigation">
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

    <a id="top"></a>

    <!-- Header Section -->
    <header id="header" class="header">

        <!-- logo-search-block -->
        <div class="logo-search-block">
            <!-- container -->
            <div class="container">
                <div class="row" style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-12 col-md-12 col-lg-3 ow-left-padding  d-flex align-items-center" style="margin-top: 15px; margin-bottom: 15px;">
                        <div class="input-group input-group1">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                            <input type="text" class="form-control" placeholder="Search products">
                        </div><!-- /input-group -->
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 logo-block">
                        <a title="Logo" href="index.html">
                            <?= $html->image('cc_logo.png', ['alt' => 'add-banner', 'style' => 'width: 80%; height: auto; margin-top: 15px; margin-bottom: 15px;']) ?>
                        </a>
                    </div>
                    <div class="col-12 col-md-12 col-lg-3 ow-right-padding ">
                        <div class="row" style="display: flex; justify-content: space-between; align-items: center;">
                            <!-- Login and Register -->
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 ow-right-padding ow-right-padding2 d-flex justify-content-end">
                                <a title="Login"
                                    id="top_link"
                                    style="margin-right: 10px; margin-top: 15px; margin-bottom: 15px;"
                                    href="<?= $this->Url->build(['controller' => 'Auth', 'action' => 'login']) ?>">LOGIN

                                </a>
                                <a title="Register"
                                    id="top_link"
                                    style="margin-right: 10px; margin-top: 15px; margin-bottom: 15px;"
                                    href="<?= $this->Url->build(['controller' => 'Auth', 'action' => 'register']) ?>">REGISTER
                                </a>
                            </div>

                            <!-- Cart -->
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 cart-link ow-right-padding d-flex justify-content-end" style="margin-top: 15px; margin-bottom: 15px;">
                                <svg width="16px" height="15px" viewBox="0 0 533.334 533.335">
                                    <g>
                                        <path
                                            d="M441.26,300.001c18.333,0,37.454-14.423,42.49-32.052l48.353-169.231c5.036-17.627-5.844-32.05-24.177-32.05H166.667   c0-36.819-29.848-66.667-66.667-66.667H0v66.667h100v283.333c0,27.614,22.386,50,50,50h316.667   c18.409,0,33.334-14.924,33.334-33.333s-14.925-33.334-33.334-33.334h-300v-33.333H441.26z M166.667,133.334h301.461l-28.573,100   H166.667V133.334z M200,491.668c0,22.916-18.75,41.666-41.667,41.666h-16.667c-22.917,0-41.667-18.75-41.667-41.666v-16.667   c0-22.917,18.75-41.667,41.667-41.667h16.667c22.917,0,41.667,18.75,41.667,41.667V491.668z M500,491.668   c0,22.916-18.75,41.666-41.667,41.666h-16.667c-22.916,0-41.666-18.75-41.666-41.666v-16.667c0-22.917,18.75-41.667,41.666-41.667   h16.667c22.917,0,41.667,18.75,41.667,41.667V491.668z" />
                                    </g>
                                </svg>
                                <!-- cart (2) -->
                                <a title="Cart" id="top_link" href="<?= $this->Url->build(['controller' => 'Cart', 'action' => 'view']) ?>">cart (2)</a>
                                <div class="cart-dropdown">
                                    <table>
                                        <tr>
                                            <td class="product-thumb"><a href="#"><?= $html->image('cart-hover-1.png', ['alt' => 'cart-hover']) ?></a></td>
                                            <td><a title="Red Cotton Top" href="#">Red Cotton Top</a></td>
                                            <td>x1</td>
                                            <td>$92.00</td>
                                            <td><a title="close" href="#"><i class="fa fa-close"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td class="product-thumb"><a href="#"><?= $html->image('cart-hover-2.png', ['alt' => 'cart-hover']) ?></a></td>
                                            <td><a title="Red Cotton Top" href="#">Red Cotton Top</a></td>
                                            <td>x1</td>
                                            <td>$92.00</td>
                                            <td><a title="close" href="#"><i class="fa fa-close"></i></a></td>
                                        </tr>
                                    </table>
                                    <div class="sub-total">
                                        <p><span>Sub Total</span> $160.00</p>
                                        <p><span>Total</span> $160.00</p>
                                    </div>
                                    <div class="cart-button">
                                        <a title="Add to cart" href="#">add to cart</a>
                                        <a title="Checkout" href="#">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- container /- -->
        </div><!-- logo-add-block /- -->

        <!-- menu-block -->
        <div class="menu-block">
            <!-- container -->
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-static-top">
                    <div class="navbar-header">
                        <a href="index.html" class="logo">
                            <?= $this->Html->image('logo.png', ['alt' => 'logo']) ?>
                        </a>
                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="nav navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" title="Products" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index']) ?>">Products</a>
                            </li>
                            <li class="nav-item dropdown mega-dropdown">
                                <a class="nav-link dropdown-toggle" title="Categories" href="#" data-bs-toggle="dropdown">Categories
                                    <div role="tooltip" class="tooltip top">
                                        <div class="tooltip-arrow"></div>
                                        <div class="tooltip-inner">New</div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu mega-dropdown-menu">
                                    <div class="row">
                                        <?php foreach ($categories as $category) : ?>
                                            <li class="col-lg-3 col-md-6 col-12">
                                                <ul>
                                                    <li class="dropdown-header"><?= h($category->name) ?></li>
                                                    <li>
                                                        <a title="<?= h($category->name) ?>" href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'view', $category->id]) ?>">
                                                            <?= h($category->name) ?>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php endforeach; ?>
                                    </div>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" title="About Us" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'about']) ?>">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" title="Contact Us" href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'contactUs']) ?>">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div><!-- container /- -->
        </div><!-- menu-block /- -->
    </header>
    <!-- Header Section /- -->

    <!-- Main Content -->
    <main>
        <?= $this->fetch('content') ?>
    </main>

    <!-- Footer Section -->
    <div id="footer-section" class="footer-section">
        <!-- informational-icons -->
        <div class="informational bottom-shadow">
            <!-- container -->
            <div class="container">
                <ul class="informational-icons">
                    <li>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span>Premium quality</span>
                    </li>
                    <li>
                        <i class="fa fa-gift" aria-hidden="true"></i>
                        <span>Perfect gift</span>
                    </li>
                    <li>
                        <i class="fa fa-leaf" aria-hidden="true"></i>
                        <span>Eco-friendly</span>
                    </li>
                    <li>
                        <i class="fa fa-trophy" aria-hidden="true"></i>
                        <span>Top Seller</span>
                    </li>
                </ul>
            </div><!-- container /- -->
        </div><!-- informational-icons /- -->

        <!-- Add Banner -->
        <div id="add-banner-section" class="add-banner-section bottom-shadow">
            <!-- container -->
            <div class="container" style="display: flex; justify-content: center; align-items: center; height: 100%; text-align: center;">
                <a title="Add-banner" href="#" style="display: flex; justify-content: center; align-items: center; width: 100%;">
                    <?= $html->image('cc_logo.png', ['alt' => 'add-banner', 'style' => 'width: 50%; height: auto;']) ?>
                </a>
            </div><!-- container /- -->
        </div><!-- Add Banner /- -->

        <!-- widget section -->
        <div class="widget-section bottom-shadow">
            <!-- container -->
            <div class="container">
                <div class="row" style="display: flex; justify-content: center; align-items: center;">
                    <!-- widget about -->
                    <aside class="col-12 col-md-12 col-lg-3  widget widget_about">
                        <div class="address">
                            <svg viewBox="0 0 512 512">
                                <path
                                    d="M192,307.188V160l128-96v227.5c-6.281,0.656-12.938,1.344-20.094,2.062c-27.969,2.813-62.781,6.313-107.281,13.531   L192,307.188z M488.344,145.813L352,64v223.125C406.281,277.188,426.531,253.375,488.344,145.813z M352,319.312V416l160,96V168.719   C445.719,282.938,421,307.906,352,319.312z M21.594,428.938L160,512V344.719C112.031,353.188,66.031,368,21.594,428.938z    M303.094,325.406c-27.531,2.781-61.813,6.219-105.344,13.25l-5.75,0.906V512l128-96v-92.375   C314.531,324.219,309.062,324.812,303.094,325.406z M80,144c-5.469,0-10.813-0.563-16-1.625V256l32-16v-97.625   C90.813,143.438,85.469,144,80,144z M80,0C44.656,0,16,28.625,16,64s28.656,64,64,64c35.375,0,64-28.625,64-64S115.375,0,80,0z    M64,80c-17.688,0-32-14.313-32-32s14.313-32,32-32s32,14.313,32,32S81.688,80,64,80z M128,146.656v113.125l-96,48V146.656   c-12.875-7.531-23.781-18-32-30.344v288.156C52.25,336.25,108.219,321,160,312.25V160l-27.375-16.438   C131.063,144.594,129.625,145.719,128,146.656z" />
                            </svg>
                            <h4>CC Headquarterss </h4>
                            <p>121 King Street, Melbourne </p>
                            <p>Victoria 3000 Australia</p>
                        </div>
                        <div class="helpline">
                            <svg viewBox="0 0 51.413 51.413">
                                <path
                                    d="M25.989,12.274c8.663,0.085,14.09-0.454,14.823,9.148h10.564c0-14.875-12.973-16.88-25.662-16.88    c-12.69,0-25.662,2.005-25.662,16.88h10.482C11.345,11.637,17.398,12.19,25.989,12.274z" />
                                <path
                                    d="M5.291,26.204c2.573,0,4.714,0.154,5.19-2.377c0.064-0.344,0.101-0.734,0.101-1.185H10.46H0    C0,26.407,2.369,26.204,5.291,26.204z" />
                                <path
                                    d="M40.88,22.642h-0.099c0,0.454,0.039,0.845,0.112,1.185c0.502,2.334,2.64,2.189,5.204,2.189    c2.936,0,5.316,0.193,5.316-3.374H40.88z" />
                                <path
                                    d="M35.719,20.078v-1.496c0-0.669-0.771-0.711-1.723-0.711h-1.555c-0.951,0-1.722,0.042-1.722,0.711    v1.289v1h-11v-1v-1.289c0-0.669-0.771-0.711-1.722-0.711h-1.556c-0.951,0-1.722,0.042-1.722,0.711v1.496v1.306    C12.213,23.988,4.013,35.073,3.715,36.415l0.004,8.955c0,0.827,0.673,1.5,1.5,1.5h40c0.827,0,1.5-0.673,1.5-1.5v-9    c-0.295-1.303-8.493-12.383-11-14.987V20.078z M19.177,37.62c-0.805,0-1.458-0.652-1.458-1.458s0.653-1.458,1.458-1.458    s1.458,0.652,1.458,1.458S19.982,37.62,19.177,37.62z M19.177,32.62c-0.805,0-1.458-0.652-1.458-1.458s0.653-1.458,1.458-1.458    s1.458,0.652,1.458,1.458S19.982,32.62,19.177,32.62z M19.177,27.621c-0.805,0-1.458-0.652-1.458-1.458    c0-0.805,0.653-1.458,1.458-1.458s1.458,0.653,1.458,1.458C20.635,26.969,19.982,27.621,19.177,27.621z M25.177,37.62    c-0.805,0-1.458-0.652-1.458-1.458s0.653-1.458,1.458-1.458c0.806,0,1.458,0.652,1.458,1.458S25.983,37.62,25.177,37.62z     M25.177,32.62c-0.805,0-1.458-0.652-1.458-1.458s0.653-1.458,1.458-1.458c0.806,0,1.458,0.652,1.458,1.458    S25.983,32.62,25.177,32.62z M25.177,27.621c-0.805,0-1.458-0.652-1.458-1.458c0-0.805,0.653-1.458,1.458-1.458    c0.806,0,1.458,0.653,1.458,1.458C26.635,26.969,25.983,27.621,25.177,27.621z M31.177,37.62c-0.806,0-1.458-0.652-1.458-1.458    s0.652-1.458,1.458-1.458s1.458,0.652,1.458,1.458S31.983,37.62,31.177,37.62z M31.177,32.62c-0.806,0-1.458-0.652-1.458-1.458    s0.652-1.458,1.458-1.458s1.458,0.652,1.458,1.458S31.983,32.62,31.177,32.62z M31.177,27.621c-0.806,0-1.458-0.652-1.458-1.458    c0-0.805,0.652-1.458,1.458-1.458s1.458,0.653,1.458,1.458C32.635,26.969,31.983,27.621,31.177,27.621z" />
                            </svg>
                            <h4>Help Lines</h4>
                            <p>+61 3 8376 6284</p>
                            <p>+61 3 8376 6285</p>
                        </div>
                    </aside><!-- widget about /- -->

                    <!-- col-md-6 -->
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="row">
                            <aside class="col-12  col-sm-4 col-md-4 col-lg-4 widget widget_list_style">
                                <h3 class="widget-title">
                                    Our Stores
                                </h3>
                                <ul>
                                    <li><a title="Mumbai" href="#">Mumbai</a></li>
                                    <li><a title="INDORE" href="#">INDORE</a></li>
                                    <li><a title="Toronto" href="#">Toronto</a></li>
                                    <li><a title="Sidney" href="#">Sidney</a></li>
                                    <li><a title="New York" href="#">New York</a></li>
                                    <li><a title="Paris" href="#">Paris</a></li>
                                </ul>
                            </aside>


                            <aside class="col-12 col-sm-4 col-md-4 col-lg-4 widget widget_list_style">
                                <h3 class="widget-title">
                                    Orders
                                </h3>
                                <ul>
                                    <li><a title="Order Status" href="#">Order Status</a></li>
                                    <li><a title="My Order History" href="#">My Order History</a></li>
                                    <!-- <li><a title="My Favorites" href="#">My Favorites</a></li> -->
                                    <!-- <li><a title="Promo codes" href="#">Promo codes</a></li> -->
                                    <li><a title="Payments" href="#">Payments</a></li>
                                    <li><a title="Returns" href="#">Returns</a></li>
                                </ul>
                            </aside>

                            <aside class=" col-12 col-sm-4 col-md-4 col-lg-4 widget widget_list_style">
                            <h3 class="widget-title">
                                Learn more
                                </h3>
                                <ul>
                                    <li><a title="About Us" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'about']) ?>">About Us</a></li>
                                    <li><a title="Contact Us" href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'contactUs']) ?>">Contact Us</a></li>
                                    <!-- <li><a title="Privacy Policy" href="#">Privacy Policy</a></li> -->
                                    <!-- <li><a title="Terms &amp; Conditions" href="#">Terms &amp; Conditions</a></li>
                                    <li><a title="FAQ" href="#">FAQ</a></li>
                                    <li><a title="Blog" href="#">Blog</a></li> -->
                                </ul>
                            </aside>
                        </div>
                    </div><!-- col-md-6 /- -->
                </div>
            </div><!-- container /- -->
        </div><!-- widget section /- -->
        <!-- Footer bottom -->
        <div class="footer-bottom">
            <!-- container -->
            <div class="container">
                <div class="row" style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-12 col-md-12 col-lg-3">
                        <a title="Payment-getway" href="#"><?= $html->image('footer/payment-getway-icon.png', ['alt' => 'payment-icon']) ?></a>
                    </div>
                </div>
            </div><!-- container /- -->
            <a title="Back-to-top" id="back-to-top" href="#back-to-top" class="back-to-top"><i
                    class="fa fa-caret-up"></i></a>
        </div><!-- Footer Bottom -->
    </div><!-- Footer Section /- -->



    <!-- jQuery Include -->
    <?= $html->script('/libraries/jquery.min.js') ?>
    <?= $html->script('/libraries/gmap/jquery.gmap.min.js') ?>
    <?= $html->script('/libraries/jquery.easing.min.js') ?>
    <?= $html->script('/libraries/bootstrap/bootstrap.bundle.min.js') ?>
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

</body>

</html>
