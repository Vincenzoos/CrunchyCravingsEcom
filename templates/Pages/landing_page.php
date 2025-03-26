<!-- filepath: c:\xampp\htdocs\team068-onboarding-project\templates\Pages\landing_page.php -->
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <?= $this->Html->script('/vendor/bootstrap/js/bootstrap.bundle.min.js') ?> -->
    <!-- Custom CSS -->
    <?= $this->Html->css(['style', 'landing_page']) ?>

    <script>
        document.documentElement.classList.add('no-scroll'); // Adds class to <html> to prevent scrolling
    </script>
</head>

<body>
    <!-- Heading Banner -->
    <section id="heading-banner">
        <header id="heading-inner" class="text-center py-3">
            <!-- <h1>CrunchyCravings</h1> -->
            <?= $this->Html->image('CC Logo.png', ['class' => 'img-fluid', 'alt' => 'CrunchyCravings']) ?>
        </header>
    </section>

    <!-- Quote Section -->
    <section id="quote">
        <h4 class="text-center"><em>"Premium Lavosh crackers that pair perfectly with wine and other fine foods."</em></h4>
    </section>

    <!-- Intro Section -->
    <div id="intro" class="d-flex align-items-center justify-content-center" onclick="fadeToLandingPage()">
        <div class="text-center">
            <h1 class="display-4 text-white">Welcome to</h1>
            <h1 class="display-1 text-white">CrunchyCravings</h1>
            <p class="lead text-white">Click anywhere to explore</p>
        </div>
    </div>

    <!-- Landing Page -->
    <div id="landing-page">
        <!-- About Us Section -->
        <section id="about" class="d-flex align-items-center">
            <div class="container-fluid d-flex">
                <!-- Left Text Section -->
                <div class="about-text col-md-4">
                    <h2>About Us</h2>
                    <p>CrunchyCravings offers premium Lavosh crackers that pair perfectly with wine and other fine foods. Whether for social gatherings or as a gift, our products are designed to impress.</p>
                    <ul class="features-list">
                        <li><i class="fas fa-star"></i> Premium Quality</li>
                        <li><i class="fas fa-gift"></i> Perfect Gift</li>
                        <li><i class="fas fa-leaf"></i> Eco-Friendly</li>
                    </ul>
                </div>
                <!-- Right Image Section -->
                <div class="about-image col-md-8">
                    <?= $this->Html->image('Banner.png', ['class' => 'img-fluid', 'alt' => 'About Us']) ?>
                </div>
            </div>
        </section>

        <!-- Our Products Section -->
        <section id="products" class="py-5">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left Carousels Section -->
                    <div class="products-carousels col-md-8">
                        <!-- Carousel 1 -->
                        <div id="carousel1" class="carousel slide mb-5" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <?= $this->Html->image('Classic.jpg', ['class' => 'd-block w-100', 'alt' => 'Classic 1']) ?>
                                </div>
                                <div class="carousel-item">
                                    <?= $this->Html->image('Classic.jpg', ['class' => 'd-block w-100', 'alt' => 'Classic 2']) ?>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel1" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel1" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <!-- Carousel 2 -->
                        <div id="carousel2" class="carousel slide mb-5" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <?= $this->Html->image('Seasonal.jpg', ['class' => 'd-block w-100', 'alt' => 'Seasonal 1']) ?>
                                </div>
                                <div class="carousel-item">
                                    <?= $this->Html->image('Seasonal.jpg', ['class' => 'd-block w-100', 'alt' => 'Seasonal 2']) ?>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel2" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel2" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <!-- Carousel 3 -->
                        <div id="carousel3" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <?= $this->Html->image('Hamper.webp', ['class' => 'd-block w-100', 'alt' => 'Hamper 1']) ?>
                                </div>
                                <div class="carousel-item">
                                    <?= $this->Html->image('Hamper.webp', ['class' => 'd-block w-100', 'alt' => 'Hamper 2']) ?>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel3" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel3" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <!-- Right Text Section -->
                    <div class="products-text col-md-4">
                        <div class="inner-container">
                            <h2>Our Products</h2>
                            <p>Explore our range of premium Lavosh crackers:</p>
                            <ul class="product-types">
                                <li><strong>Classic Favorites:</strong> Timeless dishes that never go out of style.</li>
                                <li><strong>Seasonal Specials:</strong> Unique flavors crafted with seasonal ingredients.</li>
                                <li><strong>Signature Hampers:</strong> Perfect for gifting and special occasions.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-5">
            <div class="container text-center">
                <h2 class="mb-4">Contact Us</h2>
                <p class="lead">Reserve your table today and experience the magic of fine dining.</p>
                    <a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'contactUs']) ?>" class="btn btn-primary">Contact Us</a>
            </div>
        </section>

    </div>

    <!-- JavaScript for Smooth fade -->
    <script>
        function fadeToLandingPage() {
            const intro = document.getElementById('intro');
            const landingPage = document.getElementById('landing-page');

            // Fade out the intro section
            intro.style.opacity = '0';

            // Wait for the fade-out transition to complete
            setTimeout(() => {
                intro.style.display = 'none'; // Hide the intro section
                intro.remove(); // Completely remove the intro section from the DOM
                landingPage.style.opacity = '1'; // Fade in the landing page

                // Re-enable scrolling after the fade transition
                document.documentElement.classList.remove('no-scroll'); // Remove class from <html>
            }, 1000); // Match the transition duration (1s)
        }
    </script>

    <!-- Custom JavaScript for staggered carousels -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Set the same interval for all carousels
            const interval = 6000; // 6 seconds

            // Initialize all carousels but pause them immediately
            const carousel1 = new bootstrap.Carousel('#carousel1', { interval, ride: false });
            const carousel2 = new bootstrap.Carousel('#carousel2', { interval, ride: false });
            const carousel3 = new bootstrap.Carousel('#carousel3', { interval, ride: false });

            // Start the first carousel immediately
            carousel1.cycle();

            // Start the second carousel after a delay
            setTimeout(() => {
                carousel2.cycle();
            }, 2000);

            // Start the third carousel after a delay
            setTimeout(() => {
                carousel3.cycle();
            }, 4000);

            // Add event listeners to buttons for manual control
            document.querySelectorAll('.carousel-control-prev, .carousel-control-next').forEach(button => {
                button.addEventListener('click', (event) => {
                    const targetCarousel = button.closest('.carousel'); // Find the closest carousel
                    if (!targetCarousel) return; // Ensure the button is inside a carousel

                    const carouselInstance = bootstrap.Carousel.getInstance(`#${targetCarousel.id}`);
                    if (button.classList.contains('carousel-control-prev')) {
                        carouselInstance.prev(); // Go to the previous slide
                        console.log(`Previous button clicked for ${targetCarousel.id}`);
                    } else if (button.classList.contains('carousel-control-next')) {
                        carouselInstance.next(); // Go to the next slide
                        console.log(`Next button clicked for ${targetCarousel.id}`);
                    }
                });
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
