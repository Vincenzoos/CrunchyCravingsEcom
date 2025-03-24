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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Igniv-Inspired Website</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <?= $this->Html->css(['style', 'landing_page']) ?>
</head>

<body>
    <!-- Hero Section -->
    <!-- <header class="hero-section text-center text-white d-flex align-items-center justify-content-center">
        <div class="container">
            <img src="img/logo.png" alt="Logo" class="img-fluid mb-4">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header> -->

    <!-- Intro Section -->
    <section id="intro">
        <div class="container text-center py-5">
            <h1 class="display-4">Welcome to CrunchyCravings</h1>
            <p class="lead">Discover the art of fine dining with our exquisite menu and luxurious ambiance.</p>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <div class="container-fluid text-center py-5">
            <h3>Our Product</h3>
            <p>CrunchyCravings offers premium Lavosh crackers that pair perfectly with wine and other fine foods. Whether for social gatherings or as a gift, our products are designed to impress.</p>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features">
        <div class="container-fluid text-center py-5">
            <div class="row">
                <div class="col-md-4">
                    <i class="fas fa-star fa-3x text-primary"></i>
                    <h4>Premium Quality</h4>
                    <p>Our Lavosh crackers are crafted with the finest ingredients.</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-gift fa-3x text-primary"></i>
                    <h4>Perfect Gift</h4>
                    <p>Beautifully packaged for any occasion.</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-leaf fa-3x text-primary"></i>
                    <h4>Eco-Friendly</h4>
                    <p>We care about the environment with sustainable packaging.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu">
        <div class="container-fluid text-center py-5 px-0">
            
            <h3 class="text-center mb-4">Our Menu</h3>
                
            <div class="card-group">
                <div class="card">
                    <?= $this->Html->image('Classic.jpg', ['style' => 'height: 300px; object-fit: cover;', 'class' => 'card-img-top', 'alt' => 'Classic Favorites']) ?>
                    <div class="card-body">
                        <h5 class="card-title">Classic Favorites</h5>
                        <p class="card-text">Timeless dishes that never go out of style.</p>
                    </div>
                </div>
                <div class="card">
                <?= $this->Html->image('Seasonal.jpg', ['style' => 'height: 300px; object-fit: cover;', 'class' => 'card-img-top', 'alt' => 'Classic Favorites']) ?>
                    <div class="card-body">
                    <h5 class="card-title">Seasonal Special</h5>
                    <p class="card-text">Alternative flavour profiles cooked with seasonal ingredients.</p>
                    <p class="card-text"><small class="text-muted">Last updated 1 month ago</small></p>
                    </div>
                </div>
                <div class="card">
                <?= $this->Html->image('Hamper.webp', ['style' => 'height: 300px; object-fit: cover;', 'class' => 'card-img-top', 'alt' => 'Classic Favorites']) ?>
                    <div class="card-body">
                    <h5 class="card-title">Signature hampers</h5>
                    <p class="card-text"></p>
                    <p class="card-text"><small class="text-muted">Last updated 2 weeks ago</small></p>
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
            <a href="#contact" class="btn btn-primary">Contact Us</a>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>