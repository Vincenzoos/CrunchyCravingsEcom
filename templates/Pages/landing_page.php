<?php
/**
 * Landing Page for CrunchyCravings
 *
 * @description This is the landing page for CrunchyCravings, showcasing the product and its features.
 * @author      Vuk Todorovic
 * @date        23-03-2025
 * @notes       routes.php loads this page by default instead of home.php
 *
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Home');
?>

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings</title>
    
    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'landing_page']) ?>

    <?= $html->script('/libraries/jquery.min.js') ?>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Landing Page -->
    <div id="landing-page">
        <!-- Hero Section -->
        <section id="hero-container" class="py-5">
            <div id="hero" class="container">
                <div class="row justify-content-center">
                    <!-- Left Text Section -->
                    <div class="col-md-4 text-center text-md-start">
                        <h1 class="display-3 fw-bold">Discover And Explore Premium Lavosh Crackers</h1>
                        <p class="lead" style="margin-top: 1rem; margin-bottom: 1rem;">CrunchyCravings offers premium Lavosh crackers that pair perfectly with wine and other fine foods. Whether for social gatherings or as a gift, our products are designed to impress.</p>
                        <div class="d-flex justify-content-center">
                            <a href="<?= $this->App->appUrl(['controller' => 'Products', 'action' => 'customerIndex']) ?>" class="btn btn-outline-primary btn-lg me-3">Buy Now</a>
                            <a href="<?= $this->App->appUrl(['controller' => 'Contacts', 'action' => 'contactUs']) ?>" class="btn btn-outline-primary btn-lg ms-auto">Contact Us</a>
                        </div>
                    </div>

                    <!-- Empty column -->
                    <div class="col-md-1"></div>

                    <!-- Right Image Section -->
                    <div class="col-md-5 text-center">
                        <?= $this->Html->image('crackers.png', ['class' => 'img-fluid', 'alt' => 'Lavosh Crackers', 'style' => 'width: 100%;']) ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Products Section -->
        <section id="products" class="py-5">
            <div class="container text-center">
                <h2 class="mb-4">Our Products</h2>
                <div class="product-tabs d-flex justify-content-center gap-3">
                    <div class="tab-item active" data-product="classic">Classic Favorites</div>
                    <div class="tab-item" data-product="modern">Modern Twists</div>
                    <div class="tab-item" data-product="signature">Signature Hampers</div>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-md-4 product-description">
                        <h3 id="product-title">Classic Favorites</h3>
                        <p id="product-description" class="lead">
                            Timeless dishes that never go out of style. Perfect for any occasion.
                            <ul>
                                <li>Perfectly baked Lavosh crackers</li>
                                <li>Pairs well with wine and cheese</li>
                                <li>Great for gifting or gatherings</li>
                            </ul>
                        </p>
                    </div>
                    <div class="col-md-4 product-description">
                        <div id="product-image">
                            <?= $this->Html->image('Classic.jpg', ['class' => 'img-fluid', 'alt' => 'Classic Favorites', 'style' => 'width: 100%;']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
            
        <!-- <h3>We Also Offer A Range Of Packages And Deals</h3>
        <p class="lead">CrunchyCravings provides a range of different packages and deals for social events and gatherings.</p> -->

        <!-- <li><strong>Classic Favorites:</strong> Timeless dishes that never go out of style.</li>
        <li><strong>Seasonal Specials:</strong> Unique flavors crafted with seasonal ingredients.</li>
        <li><strong>Signature Hampers:</strong> Perfect for gifting and special occasions.</li> -->

        <!-- Contact Section -->
        <section id="contact" class="py-5">
            <div class="container text-center">
                <h2 class="mb-4">Contact Us</h2>
                <p class="lead">Reserve your table today and experience the magic of fine dining.</p>
                <!-- <a href="<?= $this->App->appUrl(['controller' => 'Contacts', 'action' => 'contactUs']) ?>" class="btn btn-primary">Contact Us</a> -->
                <a href="<?= $this->App->appUrl(['controller' => 'Contacts', 'action' => 'contactUs']) ?>" class="btn btn-outline-primary btn-lg ms-auto">Contact Us</a>
            </div>
        </section>

    </div>

    <!-- Custom script for switchable product type descriptions -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const productData = {
                classic: {
                    title: "Classic Favorites",
                    description: `
                        Timeless dishes that never go out of style. Perfect for any occasion.
                        <ul>
                            <li>Perfectly baked Lavosh crackers</li>
                            <li>Pairs well with wine and cheese</li>
                            <li>Great for gifting or gatherings</li>
                        </ul>
                    `,
                    image: "Classic.jpg"
                },
                modern: {
                    title: "Modern Twists",
                    description: `
                        Innovative flavors for the adventurous palate.
                        <ul>
                            <li>Unique seasoning blends</li>
                            <li>Perfect for modern dining experiences</li>
                            <li>Pairs well with craft beverages</li>
                        </ul>
                    `,
                    image: "Modern.jpg"
                },
                signature: {
                    title: "Signature Hampers",
                    description: `
                        Perfect for gifting and special occasions.
                        <ul>
                            <li>Beautifully packaged hampers</li>
                            <li>Includes a variety of premium crackers</li>
                            <li>Ideal for celebrations and events</li>
                        </ul>
                    `,
                    image: "Large.jpg"
                }
            };

            const tabs = document.querySelectorAll('.tab-item');
            const productTitle = document.getElementById('product-title');
            const productDescription = document.getElementById('product-description');
            const productImage = document.getElementById('product-image');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    // Add active class to the clicked tab
                    tab.classList.add('active');

                    // Get product data
                    const productKey = tab.getAttribute('data-product');
                    const product = productData[productKey];

                    // Update content
                    productTitle.textContent = product.title;
                    productDescription.innerHTML = product.description;
                    // productImage.innerHTML = `<?= $this->Html->image('${product.image}', ['class' => 'img-fluid', 'alt' => '${product.title}', 'style' => 'width: 100%;']) ?>`;
                    productImage.innerHTML = `<img src="/team068-app_fit3047/img/${product.image}" class="img-fluid" alt="${product.title}" style="width: 100%;">`;
                });
            });
        });
    </script>

    <!-- Bootstrap JS -->
    
</body>

</html>
