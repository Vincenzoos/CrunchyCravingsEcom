<!-- filepath: c:\xampp\htdocs\team068-onboarding-project\templates\Auth\change_password.php -->
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->assign('title', 'Change Password');
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
    <?= $this->Html->css(['style', 'change_password']) ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Heading Banner -->
        <section id="heading-banner">
            <header id="heading-inner" class="text-center py-3">
                <?= $this->Html->image('CC Logo.png', ['class' => 'img-fluid', 'alt' => 'CrunchyCravings']) ?>
            </header>
        </section>

        <!-- Change Password Section -->
        <section id="change-password" class="text-center py-5">
            <div class="container">
                <h1 class="display-4">Change Password</h1>
                <p class="lead">Update your password below.</p>
            </div>
        </section>

        <!-- Change Password Form Section -->
        <section id="change-password-form" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="users-form-content text-center">
                            <?= $this->Form->create($user) ?>
                            <fieldset>
                                <h1 class="mb-4">Update Your Password</h1>
                                <?= $this->Flash->render() ?>
                                <div class="mb-4">
                                    <?= $this->Form->control('password', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">New Password</h3>', 'escape' => false],
                                        'placeholder' => 'Enter your new password...',
                                        'type' => 'password',
                                        'required' => true,
                                    ]); ?>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('password_confirm', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">Confirm Password</h3>', 'escape' => false],
                                        'placeholder' => 'Retype your new password...',
                                        'type' => 'password',
                                        'required' => true,
                                    ]); ?>
                                </div>
                            </fieldset>
                            <div class="text-center">
                                <?= $this->Form->button('Update Password', ['class' => 'btn btn-primary btn-lg']) ?>
                            </div>
                            <?= $this->Form->end() ?>

                            <hr class="my-4">

                            <div class="text-center">
                                <?= $this->Html->link('Back to Profile', ['controller' => 'Users', 'action' => 'profile'], ['class' => 'btn btn-link']) ?>
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