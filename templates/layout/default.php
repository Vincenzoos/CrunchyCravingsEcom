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
    <link rel="icon" type="image/png" href="<?= $this->Url->image('logo.png') ?>">
    <title><?= $this->fetch('title') ?> - CrunchyCravings</title>


    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?= $this->Html->css(['/vendor/fontawesome-free/css/all.min.css', 'custom', 'default.css', 'flash.css']) ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body id="page-top">

    <!-- Sidebar Toggle Button -->
    <button id="sidebarToggle" class="btn btn-primary sidebar-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="sidebarLabel">Menu</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group">
                <!-- If user is not log in, show in sidebar as login button                 -->
                <?php if (!$this->Identity->isLoggedIn()) : ?>
                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page'])?>" class="list-group-item">Home page</a>
                    <a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'contactUs'])?>" class="list-group-item">Contact us</a>
                    <a href="<?= $this->Url->build(['controller' => 'Auth', 'action' => 'login']) ?>" class="list-group-item">Log in</a>
                    <!-- Else, show in sidebar as logout button -->
                    <?php endif; ?>
                    <?php if ($this->Identity->isLoggedIn()) : ?>
                        <a href="<?= $this->Url->build(['controller' => 'Auth', 'action' => 'logout']) ?>" class="list-group-item">Logout</a>
                        <a href="<?= $this->Url->build(['controller' => 'Auth', 'action' => 'changePassword', $this->Identity->get('id')]) ?>" class="list-group-item">Change Password</a>
                        <a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'index'])?>" class="list-group-item">Contacts</a>
                        <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index']) ?>" class="list-group-item">Products</a>
                <?php endif; ?>

                <!-- Options dropdown -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle list-group-item" type="button" id="optionsDropdown" data-bs-toggle="dropdown" aria-expanded="true">
                        Options
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="optionsDropdown">
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="accessibility-mode">
                                <label class="form-check-label" for="accessibility-mode">
                                    Enable Accessibility Mode
                                </label>
                                <p class="small text mt-1">Switch to a more accessible color scheme for better readability.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </ul>
        </div>
    </div>

    <div id="wrapper" class="d-flex flex-column min-vh-100">
        <!-- Main Content -->
        <div id="content" class="flex-grow-1">
            <div class="container-fluid">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer" id="footer">
            <div class="copyright">
                <span>Copyright &copy; CrunchyCravings <?= date('Y') ?></span>
            </div>
        </footer>
    </div>

    <!-- Logout Modal-->
<!--    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"-->
<!--        aria-hidden="true">-->
<!--        <div class="modal-dialog" role="document">-->
<!--            <div class="modal-content">-->
<!--                <div class="modal-header">-->
<!--                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>-->
<!--                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">-->
<!--                        <span aria-hidden="true">×</span>-->
<!--                    </button>-->
<!--                </div>-->
<!--                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>-->
<!--                <div class="modal-footer">-->
<!--                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>-->
<!--                    <a class="btn btn-primary" href="login.html">Logout</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <!-- Script to handle sidebar toggle and accessibility mode -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebarToggle');

            // Hide the toggle button when the sidebar is shown
            sidebar.addEventListener('show.bs.offcanvas', function () {
                toggleButton.style.display = 'none';
                document.body.classList.add('no-scroll'); // Add class to disable scrolling

                // Remove any existing backdrops
                const existingBackdrops = document.querySelectorAll('.offcanvas-backdrop');
                existingBackdrops.forEach(backdrop => backdrop.remove());
            });

            // Show the toggle button when the sidebar is hidden
            sidebar.addEventListener('hidden.bs.offcanvas', function () {
                toggleButton.style.display = 'block';
                document.body.classList.remove('no-scroll'); // Remove class to enable scrolling
            });

            // Detect clicks on the offcanvas-backdrop
            document.addEventListener('click', function (event) {
                const backdrop = document.querySelector('.offcanvas-backdrop');
                if (backdrop && backdrop.contains(event.target)) {
                    console.log('Backdrop clicked');
                    document.body.classList.remove('no-scroll'); // Ensure scrolling is re-enabled
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const accessibilityCheckbox = document.getElementById('accessibility-mode');

            // Function to apply accessibility mode
            function applyAccessibilityMode(isEnabled) {
                if (isEnabled) {
                    document.documentElement.style.setProperty('--sidebar-text-color', 'var(--accesible-sidebar-text-color)');
                    document.documentElement.style.setProperty('--sidebar-bg-color', 'var(--accesible-sidebar-bg-color)');
                    document.documentElement.style.setProperty('--sidebar-hover-color', 'var(--accesible-sidebar-hover-color)');
                    document.documentElement.style.setProperty('--border-color', 'var(--accessible-border-color)');
                    document.documentElement.style.setProperty('--background-color', 'var(--accessible-background-color)');
                    document.documentElement.style.setProperty('--text-color', 'var(--accessible-text-color)');
                    document.documentElement.style.setProperty('--empty-color', 'var(--accessible-empty-color)');
                    document.documentElement.style.setProperty('--icon-color', 'var(--accessible-icon-color)');
                    document.documentElement.style.setProperty('--icon-hover-color', 'var(--accessible-icon-hover-color)');
                } else {
                    document.documentElement.style.setProperty('--sidebar-text-color', 'var(--default-sidebar-text-color)');
                    document.documentElement.style.setProperty('--sidebar-bg-color', 'var(--default-sidebar-bg-color)');
                    document.documentElement.style.setProperty('--sidebar-hover-color', 'var(--default-sidebar-hover-color)');
                    document.documentElement.style.setProperty('--border-color', 'var(--default-border-color)');
                    document.documentElement.style.setProperty('--background-color', 'var(--default-background-color)');
                    document.documentElement.style.setProperty('--text-color', 'var(--default-text-color)');
                    document.documentElement.style.setProperty('--empty-color', 'var(--default-empty-color)');
                    document.documentElement.style.setProperty('--icon-color', 'var(--default-icon-color)');
                    document.documentElement.style.setProperty('--icon-hover-color', 'var(--default-icon-hover-color)');
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

    <!-- Allow flash message to disappear when clicked on    -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const flashMessages = document.querySelectorAll('.success, .error');
            flashMessages.forEach(function (flash) {
                // Hide when clicked
                flash.addEventListener('click', function () {
                    flash.style.transition = 'opacity 0.5s ease';
                    flash.style.opacity = '0';
                    setTimeout(() => flash.remove(), 500);
                });
            });
        });
    </script>


    <!-- Bootstrap core JavaScript-->
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js') ?>
    <?= $this->fetch('script') ?>
</body>

</html>
