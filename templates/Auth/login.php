<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;

$debug = Configure::read('debug');

$this->assign('title', 'Login');
?>

<?php
$html = new HtmlHelper(new View());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CrunchyCravings</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities','form']) ?>

    <?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Contact Us Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-4">Welcome back</h1>
                <p class="lead">Enter your details below to log in securely.</p>
            </div>
        </section>

        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div id="form-content">
                            <?= $this->Form->create() ?>
                            <fieldset>
                                <?= $this->Flash->render() ?>
                                <div class="mb-4">
                                    <?= $this->Form->control('email', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3>Email</h3>', 'escape' => false],
                                        'placeholder' => 'Enter your email...',
                                        'type' => 'email',
                                        'required' => true,
                                    ]); ?>
                                </div>
                                <div class="mb-4">
                                    <h3>Password</h3>
                                    <!-- Password Requirements-->
                                    <div id="requirements-content">
                                        <ul class="text-start mt-2">
                                            <li><i class="fa fa-times text-danger" id="length-icon"></i> Must be at least 8 characters long</li>
                                            <li><i class="fa fa-times text-danger" id="uppercase-icon"></i> Must contain at least one uppercase letter</li>
                                            <li><i class="fa fa-times text-danger" id="number-icon"></i> Must contain at least one number</li>
                                            <li><i class="fa fa-times text-danger" id="special-icon"></i> Must contain at least one special character (e.g., @$!%*?&)</li>
                                        </ul>
                                    </div>
                                    <?= $this->Form->control('password', [
                                        'class' => 'form-control mx-auto',
                                        'label' => false,
                                        'placeholder' => 'Enter your password...',
                                        'type' => 'password',
                                        'minlength' => 8,
                                        'pattern' => "(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}",
                                        'title' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character.',
                                        'required' => true,
                                    ]); ?>
                                </div>
                            </fieldset>
                            <div class="text-center">
                                <?= $this->Form->button('Login', ['class' => 'btn btn-primary btn-lg']) ?>
                            </div>
                            <?= $this->Form->end() ?>

                            <hr class="my-4">

                            <div class="text-center">
                                <?= $this->Html->link('Forgot password?', ['controller' => 'Auth', 'action' => 'forgetPassword'], ['class' => 'btn btn-link']) ?>
                                <?= $this->Html->link('Register new user', ['controller' => 'Auth', 'action' => 'register'], ['class' => 'btn btn-link']) ?>
                                <?= $this->Html->link('Go to Homepage', '/', ['class' => 'btn btn-link']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const passwordInput = document.querySelector('input[type="password"]');
            const lengthIcon = document.getElementById('length-icon');
            const uppercaseIcon = document.getElementById('uppercase-icon');
            const numberIcon = document.getElementById('number-icon');
            const specialIcon = document.getElementById('special-icon');

            passwordInput.addEventListener('input', () => {
                const password = passwordInput.value;

                // Check if the password is at least 8 characters long
                if (password.length >= 8) {
                    lengthIcon.classList.remove('fa-times', 'text-danger');
                    lengthIcon.classList.add('fa-check', 'text-success');
                } else {
                    lengthIcon.classList.remove('fa-check', 'text-success');
                    lengthIcon.classList.add('fa-times', 'text-danger');
                }

                // Check if the password contains at least one uppercase letter
                if (/[A-Z]/.test(password)) {
                    uppercaseIcon.classList.remove('fa-times', 'text-danger');
                    uppercaseIcon.classList.add('fa-check', 'text-success');
                } else {
                    uppercaseIcon.classList.remove('fa-check', 'text-success');
                    uppercaseIcon.classList.add('fa-times', 'text-danger');
                }

                // Check if the password contains at least one number
                if (/\d/.test(password)) {
                    numberIcon.classList.remove('fa-times', 'text-danger');
                    numberIcon.classList.add('fa-check', 'text-success');
                } else {
                    numberIcon.classList.remove('fa-check', 'text-success');
                    numberIcon.classList.add('fa-times', 'text-danger');
                }

                // Check if the password contains at least one special character
                if (/[@$!%*?&]/.test(password)) {
                    specialIcon.classList.remove('fa-times', 'text-danger');
                    specialIcon.classList.add('fa-check', 'text-success');
                } else {
                    specialIcon.classList.remove('fa-check', 'text-success');
                    specialIcon.classList.add('fa-times', 'text-danger');
                }
            });
        });
    </script>
<body>

</html>
