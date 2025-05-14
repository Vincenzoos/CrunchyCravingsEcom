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
                <h1 class="display-6">Welcome back</h1>
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
                                    <div class="position-relative">
                                        <?= $this->Form->control('password', [
                                            'class' => 'form-control mx-auto',
                                            'label' => false,
                                            'placeholder' => 'Enter your password...',
                                            'type' => 'password',
                                            'id' => 'password-field',
                                            'minlength' => 8,
                                            'pattern' => "(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}",
                                            'title' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character.',
                                            'required' => true,
                                        ]); ?>
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
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

    <!-- Show/hide password script -->
    <script>
        $(document).ready(function() {
            // Toggle password visibility
            $(".toggle-password").click(function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        });
    </script>
<body>

</html>
