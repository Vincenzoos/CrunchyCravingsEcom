<!-- filepath: c:\xampp\htdocs\team068-onboarding-project\templates\Auth\change_password.php -->
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->assign('title', 'Forgot Password');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>
</head>

<body>
    <!-- Page Breadcrumb -->
    <!-- container -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Forgot password" href="<?= $this->Url->build(['controller' => 'Auth', 'action' => 'changePassword']) ?>">Change Password</a></li>
            </ol>
            <div class="return-home-link pull-right">
                <a title="Return to home page" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">return to home page</a>
            </div>
        </div>
    </div><!-- container /- -->
    <!-- Page Breadcrumb /- -->
    
    <!-- Change Password Section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-4">Change Password</h1>
            <p class="lead">Update your password below.</p>
        </div>
    </section>

    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Change Password Form Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="form-content" class="users-form-content text-center">
                            <?= $this->Form->create($user) ?>
                            <!--  Set password to none prevent current hashed_password to get pre-populated into the password field by CakePHP Form helper -->
                            <?= $user->password = ''; ?>
                            <fieldset>
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
                                <?= $this->Html->link('Back to Homepage', ['controller' => 'Pages', 'action' => 'display'], ['class' => 'btn btn-link']) ?>
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
