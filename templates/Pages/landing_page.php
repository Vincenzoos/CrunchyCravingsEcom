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
    <?= $this->Html->charset() ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CrunchyCravings - Premium Lavosh Crackers">
    <meta name="author" content="CrunchyCravings">
    <?= $this->Html->meta('icon') ?>

    <title>CrunchyCravings - Welcome</title>

    <!-- Custom fonts and styles -->
    <?= $this->Html->css(['/vendor/fontawesome-free/css/all.min.css']) ?>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <?= $this->Html->css(['sb-admin-2.min.css']) ?>
    <?= $this->Html->css(['landing_page.css']) ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Hero Section -->
                    <section id="intro" class="mt-5 text-center">
                        <h1 class="display-4">Welcome to CrunchyCravings</h1>
                        <p class="lead">Experience the luxury of Middle Eastern Lavosh crackers, perfect for fine dining and gifting.</p>
                        <a href="#contact" class="btn btn-primary btn-lg mt-3">Contact Us</a>
                    </section>

                    <!-- About Section -->
                    <section id="about" class="mt-5 text-center">
                        <h2>About Our Product</h2>
                        <p>CrunchyCravings offers premium Lavosh crackers that pair perfectly with wine and other fine foods. Whether for social gatherings or as a gift, our products are designed to impress.</p>
                    </section>

                    <!-- Features Section -->
                    <section id="features" class="mt-5 text-center">
                        <h2>Why Choose Us?</h2>
                        <div class="row mt-4">
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
                    </section>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>