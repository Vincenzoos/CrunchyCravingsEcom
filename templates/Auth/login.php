<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

$debug = Configure::read('debug');

$this->assign('title', 'Login');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <?= $this->Html->css(['style','login']) ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Heading Banner -->
        <section id="heading-banner">
            <header id="heading-inner" class="text-center py-3">
                <?= $this->Html->image('cc_logo.png', ['class' => 'img-fluid', 'alt' => 'CrunchyCravings']) ?>
            </header>
        </section>

            <!-- Contact Us Section -->
            <section id="welcome-back" class="text-center py-5">
            <div class="container">
                <h1 class="display-4">Welcome back</h1>
                <p class="lead">Enter your details below to log in securely.</p>
            </div>
        </section>

        <section id="login-form" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="users-form-content text-center">
                            <?= $this->Form->create() ?>
                            <fieldset>
                                <?= $this->Flash->render() ?>
                                <div class="mb-4">
                                    <?= $this->Form->control('email', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">Email</h3>', 'escape' => false],
                                        'placeholder' => 'Enter your email...',
                                        'type' => 'email',
                                        'required' => true,
                                    ]); ?>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('password', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">Password</h3>', 'escape' => false],
                                        'placeholder' => 'Enter your password...',
                                        'type' => 'password',
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<body>

</html>
