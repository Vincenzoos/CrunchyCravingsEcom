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
    <?= $this->Html->css(['utilities','shop']) ?>

	<?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body>
	<!-- Page Breadcrumb -->
	<!-- container -->
	<div class="container">
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
				<li><a title="Products" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerIndex']) ?>">Products</a></li>
				<li class="active">All Categories</li>
			</ol>
			<div class="return-home-link pull-right">
				<a title="Return to home page" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">return to home page</a>
			</div>
		</div>
	</div><!-- container /- -->
	<!-- Page Breadcrumb /- -->

	<!-- Page -->
	<div id="shop-container" class="single-product">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12 col-lg-7">
					<!-- Product Image -->
					<div id="shop-box" class="large-product" style="margin-bottom: 40px;">
						<div class="row" style="display: flex; justify-content: center; align-items: center;">
							<div id="about-slider" class="col-12 col-md-12 col-lg-9 flexslider product-slider">
								<ul class="slides">
									<?= $html->image('products/' . $product->image, ['alt' => $product->name]) ?>
								</ul>
							</div>
						</div>
					</div>

					<!-- Similar Products Section -->
					<div id="shop-box" style="padding: 20px;">
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
					<div id="shop-box" class="product-info-panel" style="padding: 40px; margin-bottom: 20px;">
						<ul class="categories-list" style="margin-bottom: 20px;">
							<li><a title="Products" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerIndex']) ?>">Products</a></li>
							<?php if (!empty($associatedCategoryIds) && !empty($allCategories)) : ?>
								<?php
								// Get the first associated category ID
								$firstCategoryId = reset($associatedCategoryIds);
								// Get the category name from allCategories
								$firstCategoryName = $allCategories[$firstCategoryId] ?? 'Unknown Category';
								?>
								<li><a title="<?= h($firstCategoryName) ?>" href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'view', $firstCategoryId]) ?>"><?= h($firstCategoryName) ?></a></li>
							<?php else : ?>
								<li>No categories available</li>
							<?php endif; ?>
						</ul>
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
						<?php if (!empty($associatedCategoryIds) && !empty($allCategories)) : ?>
							<p><strong>Associated Categories:</strong></p>
							<ul>
								<!-- Display categories with commas inbetween by looking up the associated category id and using implode -->
								<?php $categoryNames = []; ?>
								<?php foreach ($associatedCategoryIds as $categoryId): ?>
									<?php if (isset($allCategories[$categoryId])): ?>
										<?php $categoryNames[] = h($allCategories[$categoryId]); ?>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php if (!empty($categoryNames)): ?>
									<li><?= implode(', ', $categoryNames) ?></li>
								<?php endif; ?>
							</ul>
						<?php else: ?>
							<p>No associated categories available.</p>
						<?php endif; ?>
					</div>
					
					<aside id="shop-box" class="widget widget_recent_post">
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

</html>