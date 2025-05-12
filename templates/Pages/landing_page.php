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
</head>

<body>
    <!-- Landing Page -->
    <div id="landing-page">


        <!-- Landing Page -->
        <div id="landing-page">
            <!-- Hero Section -->
            <section id="hero" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- Left Text Section -->
                    <div class="col-md-4 text-center text-md-start">
                        <h1 class="display-3 fw-bold">Discover And Explore Premium Lavosh Crackers</h1>
                        <p class="lead" style="margin-top: 1rem; margin-bottom: 1rem;">CrunchyCravings offers premium Lavosh crackers that pair perfectly with wine and other fine foods. Whether for social gatherings or as a gift, our products are designed to impress.</p>
                        <div class="d-flex justify-content-center">
                        <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerIndex']) ?>" class="btn btn-primary btn-lg me-3">Buy Now</a>
                        <a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'contactUs']) ?>" class="btn btn-outline-primary btn-lg ms-auto">Contact Us</a>
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
        </div>

        <!-- Our Products Section -->
        <section id="products" class="py-5">
            <div class="container text-center">
                <h2 class="mb-4">Our Products</h2>
                <div class="product-tabs d-flex justify-content-center gap-3">
                    <div class="tab-item active">Classic Favorites</div>
                    <div class="tab-item">Seasonal Specials</div>
                    <div class="tab-item">Signature Hampers</div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 product-description mt-5">
                        <h3>Classic Favorites</h3>
                        <p class="lead">Timeless dishes that never go out of style. Perfect for any occasion.</p>
                    </div>
                    <div class="col-md-4 product-description mt-5">
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
                    <a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'contactUs']) ?>" class="btn btn-primary">Contact Us</a>
            </div>
        </section>

    </div>

    <!-- Custom JavaScript for staggered carousels -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize all carousels but pause them immediately
            const carousel1 = new bootstrap.Carousel('#carousel1', { interval: false, ride: false });
            const carousel2 = new bootstrap.Carousel('#carousel2', { interval: false, ride: false });
            const carousel3 = new bootstrap.Carousel('#carousel3', { interval: false, ride: false });

            // Add event listeners to buttons for manual control
            document.querySelectorAll('.carousel-control-prev, .carousel-control-next').forEach(button => {
                button.addEventListener('click', (event) => {
                    const targetCarousel = button.closest('.carousel'); // Find the closest carousel
                    if (!targetCarousel) return; // Ensure the button is inside a carousel

                    const carouselInstance = bootstrap.Carousel.getInstance(`#${targetCarousel.id}`);
                    if (button.classList.contains('carousel-control-prev')) {
                        carouselInstance.prev(); // Go to the previous slide
                    } else if (button.classList.contains('carousel-control-next')) {
                        carouselInstance.next(); // Go to the next slide
                    }
                });
            });
        });
    </script>

    <!-- Bootstrap JS -->
    
</body>

</html>
