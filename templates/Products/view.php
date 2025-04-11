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
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Luxury Shop Ecommerce HTML Template</title>

    <?= $html->meta('icon', 'images/favicon.png', ['type' => 'icon']) ?>
    <?= $html->css('/libraries/bootstrap/bootstrap.min.css') ?>
    <?= $html->css('/libraries/fuelux/jquery-ui.min.css') ?>
    <?= $html->css('/libraries/owl-carousel/owl.carousel.min.css') ?>
    <?= $html->css('/libraries/owl-carousel/owl.theme.default.min.css') ?>
    <?= $html->css('/libraries/fonts/font-awesome.min.css') ?>
    <?= $html->css('/libraries/animate/animate.min.css') ?>
    <?= $html->css('/libraries/flexslider/flexslider.css') ?>
    <?= $html->css('/libraries/magnific-popup.css') ?>
    <?= $html->css('/css/components.css') ?>
    <?= $html->css('/css/style.css') ?>
    <?= $html->css('/css/media.css') ?>
    <?= $html->css('/css/color-schemes/default.css', ['id' => 'color']) ?>

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

<body>
	<!-- Page Breadcrumb -->
	<!-- container -->
	<div class="container">
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
				<li><a title="Products" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index']) ?>">Products</a></li>
				<li class="active">All Categories</li>
			</ol>
			<div class="return-home-link pull-right">
				<a title="Return to home page" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">return to home page</a>
			</div>
		</div>
	</div><!-- container /- -->
	<!-- Page Breadcrumb /- -->

	<!-- Single Product -->
	<div id="single-product" class="single-product">
		<div class="container">
			<div class="row">
				<!-- Product Images -->
				<div class="col-12 col-md-12 col-lg-7">
					<div class="large-product" style="margin-bottom: 40px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
						<div class="row" style="display: flex; justify-content: center; align-items: center;">
							<div id="about-slider" class="col-12 col-md-12 col-lg-9 flexslider product-slider">
								<ul class="slides">
									<?= $html->image('products/' . $product->image, ['alt' => $product->name]) ?>
								</ul>
							</div>
						</div>
					</div>

					<!-- Similar Products Section -->
					<div id="similar-products" style="padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
						<h3 style="text-align: center;">Similar Products</h3>
						<div class="row">
							<?php foreach ($similarProducts as $similarProduct): ?>
								<div class="col-12 col-sm-6 col-md-6 col-lg-6 main-product">
									<div class="category-box product-box">
										<?php if ($similarProduct->on_sale): ?>
											<span class="sale">sales</span>
										<?php endif; ?>
										<div class="inner-product">
											<a href="<?= $this->Url->build(['action' => 'view', $similarProduct->id]) ?>">
												<?= $html->image('products/' . $similarProduct->image, ['alt' => $similarProduct->name]) ?>
											</a>
											<div class="product-box-inner">
												<ul>
													<li><a title="Add to cart" href="#">Add to cart</a></li>
												</ul>
											</div>
										</div>
									</div>
									<a title="<?= h($similarProduct->name) ?>" href="<?= $this->Url->build(['action' => 'view', $similarProduct->id]) ?>" class="product-title">
										<?= h($similarProduct->name) ?>
									</a>
									<ul class="star">
										<li>
											<?php for ($i = 1; $i <= 5; $i++): ?>
												<i class="fa <?= $i <= $similarProduct->rating ? 'fa-star' : 'fa-star-o' ?>"></i>
											<?php endfor; ?>
										</li>
									</ul>
									<span class="amount">
										<?php if ($similarProduct->original_price): ?>
											<del>&dollar;<?= $this->Number->format($similarProduct->original_price) ?></del>
										<?php endif; ?>
										&dollar;<?= $this->Number->format($similarProduct->price) ?>
									</span>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<!-- Sidebar -->
				<div class="col-12 col-md-12 col-lg-5 single-product-sidebar">
					<ul class="categories-list" style="margin-bottom: 20px;">
						<li><a title="Products" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index']) ?>">Products</a></li>
						<?php if (!empty($product->categories)): ?>
							<?php foreach ($product->categories as $category): ?>
								<li><a title="<?= h($category->name) ?>" href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'view', $category->id]) ?>"><?= h($category->name) ?></a></li>
							<?php endforeach; ?>
						<?php else: ?>
							<li>No categories available</li>
						<?php endif; ?>
					</ul>
					<div class="product-info-panel" style="border: 1px solid #ddd; padding: 40px; border-radius: 5px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
						<div class="page-header">
							<h3><?= h($product->name) ?></h3>
						</div>
						<ul class="star" style="margin-bottom: 20px;">
							<li>
								<?php for ($i = 1; $i <= 5; $i++): ?>
									<i class="fa <?= $i <= $product->rating ? 'fa-star' : 'fa-star-o' ?>"></i>
								<?php endfor; ?>
							</li>
						</ul>
						<p><strong>Availability:</strong></p>
						<p style="margin-bottom: 40px;"><?= $product->quantity > 0 ? 'In Stock' : 'Out of Stock' ?></p>
						<p><strong>The product:</strong></p>
						<p><?= h($product->description) ?></p>
					</div>

					<aside class="widget widget_recent_post">
						<div role="tabpanel">
							<ul class="nav nav-tabs bottom-shadow" role="tablist">
								<li class="nav-item" role="presentation"><a title="Pricing" id="pricingtab"
									class="nav-link active" data-bs-toggle="tab" role="tab" aria-controls="pricing"
									data-bs-target="#pricing" aria-selected="true">Pricing</a></li>
								<li class="nav-item" role="presentation"><a title="Reviews" id="reviewtab"
									class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="reviews"
									data-bs-target="#reviews" aria-selected="false">Reviews</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade show active" id="pricing" role="tabpanel"
									aria-labelledby="pricingtab">
									<div class="shopping-cart-table">
										<table>
											<tbody>
												<tr class="cart-subtotal">
													<th>Product Price</th>
													<td><span class="amount"><?= $this->Number->currency($product->price, 'USD') ?></span></td>
												</tr>
												<tr class="cart-subtotal">
													<th>Product Quantity</th>
													<td>
														<select class="minimal">
															<?php for ($i = 1; $i <= 10; $i++): ?>
																<option><?= $i ?></option>
															<?php endfor; ?>
														</select>
													</td>
												</tr>
												<tr class="order-total">
													<th>Total Price</th>
													<td><strong><span class="total-amount"><?= $this->Number->currency($product->price, 'USD') ?></span></strong></td>
												</tr>
											</tbody>
										</table>
										<ul>
											<li><a title="Buy Now" href="#" style="font-size: 0.9em; padding: 1em;">Buy Now</a></li>
											<li><a title="Add to cart" href="#" style="font-size: 0.9em; padding: 1em;">Add to cart</a></li>
										</ul>
									</div>
								</div>
								<div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviewtab">
									<div class="shopping-cart-table">
										<div class="review-box">
											<div class="col-md-5 col-sm-5">
												<h3>Review Title:</h3>
											</div>
											<div class="col-md-7 col-sm-7">
												<input type="text" placeholder="(Maximum 20 words)" />
											</div>
										</div>
										<div class="review-box">
											<div class="col-md-5 col-sm-5">
												<h3>Your Review:</h3>
											</div>
											<div class="col-md-7 col-sm-7">
												<textarea placeholder="(at least 100 characters.)"></textarea>
											</div>
											<p>Please do not include: HTML, references to other retailers, pricing,
												personal information, any profane, inflammatory or copyrighted comments,
												or any copied content.</p>
										</div>
										<div class="review-box">
											<div class="col-md-5 col-sm-5">
												<h3>Review Title:</h3>
											</div>
											<div class="col-md-7 col-sm-7">
												<p>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													(Click to rate on scale of 1-5)
												</p>
											</div>
										</div>
										<div class="review-box">
											<div class="col-md-5 col-sm-5">
												<h3>Name</h3>
											</div>
											<div class="col-md-7 col-sm-7">
												<input type="text" placeholder="(First and last name)" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</div>
	<!-- Single Product /- -->

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