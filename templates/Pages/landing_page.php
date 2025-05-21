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
                    <div class="col-md-5 text-center text-md-start" style="max-width: 400px;">
                        <h1 class="display-3 fw-bold"><?= $this->ContentBlock->text('hero-heading') ?></h1>
                        <p class="lead" style="margin-top: 1rem; margin-bottom: 1rem;">
                            <?= $this->ContentBlock->text('hero-text') ?>
                        </p>
                        <div class="d-flex justify-content-center">
                            <a href="<?= $this->App->appUrl(['controller' => 'Products', 'action' => 'customerIndex']) ?>" class="btn btn-outline-primary btn-lg me-3">Buy Now</a>
                            <a href="<?= $this->App->appUrl(['controller' => 'Contacts', 'action' => 'contactUs']) ?>" class="btn btn-outline-primary btn-lg ms-auto">Contact Us</a>
                        </div>
                    </div>

                    <!-- Empty column -->
                    <?php if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/\b(?:Windows|Macintosh|Linux|X11)\b/i', $_SERVER['HTTP_USER_AGENT'])): ?>
                        <script>
                            if (window.innerWidth > 1000) {
                                document.write('<div class="col-md-1"></div>');
                            }
                        </script>
                    <?php endif; ?>


                    <!-- Right Image Section -->
                    <div id="hero-image" class="col-md-5 text-center">
                        <?= $this->ContentBlock->image('hero-image') ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Products Section -->
        <section id="products" class="py-5">
            <div id="products-container" class="container text-center">
                <h2 class="mb-4">Our Products</h2>
                <div class="product-tabs d-flex justify-content-center gap-3">
                    <div class="tab-item active" data-product="classic">Classic Favorites</div>
                    <div class="tab-item" data-product="modern">Modern Twists</div>
                    <div class="tab-item" data-product="signature">Signature Hampers</div>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-md-6 product-description">
                        <h3 id="product-title">Classic Favorites</h3>
                        <p id="product-description" class="lead"></p>
                    </div>
                    <div class="col-md-6 product-description">
                        <div id="classic-image">
                            <?= $this->ContentBlock->image('classic-image', ['style' => 'width: 100%;']) ?>
                        </div>
                        <div id="modern-image"  style="display: none;">
                            <?= $this->ContentBlock->image('modern-image', ['style' => 'width: 100%;']) ?>
                        </div>
                        <div id="signature-image" style="display: none;">
                            <?= $this->ContentBlock->image('signature-image', ['style' => 'width: 100%;']) ?>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="<?= $this->App->appUrl(['controller' => 'Products', 'action' => 'customerIndex']) ?>" class="btn btn-outline-primary btn-lg">
                        View products
                    </a>
                </div>
            </div>
        </section>

        <!-- Our Mission Section -->
        <section id="our-mission" class="py-5">
            <div id="mission-container" class="container text-center">
                <h2 class="mb-4">Our Mission</h2>
                <div class="row justify-content-center">

                    <!-- Left Text Section -->
                    <div id="mission-text" class="col-md-6">
                        <p class="lead">
                            <?= $this->ContentBlock->text('mission-text') ?>
                        </p>
                        <p class="lead">
                            - CrunchyCravings Team
                        </p>
                    </div>

                    <!-- Right Image Section -->
                    <div id="mission-image" class="col-md-6">
                        <?= $this->ContentBlock->image('mission-image', ['class' => 'img-fluid rounded', 'alt' => 'Our Mission', 'style' => 'width: 100%;']) ?>
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
                <p class="lead">Enquire about gourmet lavosh products today.</p>
                <!-- <a href="<?= $this->App->appUrl(['controller' => 'Contacts', 'action' => 'contactUs']) ?>" class="btn btn-primary">Contact Us</a> -->
                <a href="<?= $this->App->appUrl(['controller' => 'Contacts', 'action' => 'contactUs']) ?>" class="btn btn-outline-primary btn-lg ms-auto">Contact Us</a>
            </div>
        </section>

    </div>

    <!-- Script for switchable product type descriptions -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.tab-item');
            const productTitle = document.getElementById('product-title');
            const productDescription = document.getElementById('product-description');

            // Get references to all image containers
            const classicImage = document.getElementById('classic-image');
            const modernImage = document.getElementById('modern-image');
            const signatureImage = document.getElementById('signature-image');

            // Function to update the content dynamically
            const updateContent = (productKey) => {
                let title = '';
                let description = '';

                // Hide all images first
                classicImage.style.display = 'none';
                modernImage.style.display = 'none';
                signatureImage.style.display = 'none';

                switch (productKey) {
                    case 'classic':
                        title = "Classic Favorites";
                        description = `
                            Timeless dishes that never go out of style. Perfect for any occasion.
                            <ul>
                                <li>Perfectly baked Lavosh crackers</li>
                                <li>Pairs well with wine and cheese</li>
                                <li>Great for gifting or gatherings</li>
                            </ul>
                        `;
                        // Show classic image
                        classicImage.style.display = 'block';
                        modernImage.style.display = 'none';
                        signatureImage.style.display = 'none';
                        break;

                    case 'modern':
                        title = "Modern Twists";
                        description = `
                            Innovative flavors for the adventurous palate.
                            <ul>
                                <li>Unique seasoning blends</li>
                                <li>Perfect for modern dining experiences</li>
                                <li>Pairs well with craft beverages</li>
                            </ul>
                        `;
                        // Show modern image
                        classicImage.style.display = 'none';
                        modernImage.style.display = 'block';
                        signatureImage.style.display = 'none';
                        break;

                    case 'signature':
                        title = "Signature Hampers";
                        description = `
                            Perfect for gifting and special occasions.
                            <ul>
                                <li>Beautifully packaged hampers</li>
                                <li>Includes a variety of premium crackers</li>
                                <li>Ideal for celebrations and events</li>
                            </ul>
                        `;
                        // Show signature image
                        classicImage.style.display = 'none';
                        modernImage.style.display = 'none';
                        signatureImage.style.display = 'block';
                        break;
                }

                // Update the DOM elements
                productTitle.textContent = title;
                productDescription.innerHTML = description;
            };

            // Initialize content with the default active tab
            const defaultProduct = document.querySelector('.tab-item.active').getAttribute('data-product');
            updateContent(defaultProduct);

            // Add event listeners to tabs
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    // Add active class to the clicked tab
                    tab.classList.add('active');

                    // Update content based on the clicked tab
                    const productKey = tab.getAttribute('data-product');
                    updateContent(productKey);
                });
            });
        });
    </script>

    <!-- Bootstrap JS -->

</body>

</html>
