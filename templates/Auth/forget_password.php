<!-- filepath: c:\xampp\htdocs\team068-onboarding-project\templates\Auth\forget_password.php -->
<?php
/**
 * @var \App\View\AppView $this
 */

$this->assign('title', 'Forgot Password');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <?= $this->Html->css(['custom', 'forget_password']) ?>
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

        <!-- Forgot Password Section -->
        <section id="forgot-password" class="text-center py-5">
            <div class="container">
                <h1 class="display-4">Forgot Password</h1>
                <p class="lead">Enter your email address to reset your password.</p>
            </div>
        </section>

        <!-- Forgot Password Form Section -->
        <section id="forgot-password-form" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="users-form-content text-center">
                            <?= $this->Form->create() ?>
                            <fieldset>
                                <h1 class="mb-4">Reset Your Password</h1>
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
                            </fieldset>
                            <div class="text-center">
                                <?= $this->Form->button('Send Verification Email', ['class' => 'btn btn-primary btn-lg']) ?>
                            </div>
                            <?= $this->Form->end() ?>

                            <hr class="my-4">

                            <div class="text-center">
                                <?= $this->Html->link('Back to Login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'btn btn-link']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
