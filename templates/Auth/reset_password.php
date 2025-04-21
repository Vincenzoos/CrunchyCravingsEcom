<!-- filepath: c:\xampp\htdocs\team068-onboarding-project\templates\Auth\reset_password.php -->
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->assign('title', 'Reset Password');
?>

<!DOCTYPE html>
<html lang="en">

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <?= $this->Html->css(['custom', 'reset_password']) ?>

    <?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Reset Password Section -->
        <section id="reset-password" class="text-center py-5">
            <div class="container">
                <h1 class="display-4">Reset Password</h1>
                <p class="lead">Enter your new password below.</p>
            </div>
        </section>

        <!-- Reset Password Form Section -->
        <section id="reset-password-form" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="users-form-content text-center">
                            <?= $this->Form->create($user) ?>
                            <!--  Set password to none prevent current hashed_password to get pre-populated into the password field by CakePHP Form helper -->
                            <?= $user->password = ''; ?>
                            <fieldset>
                                <legend class="mb-4">Reset Your Password</legend>
                                <?= $this->Flash->render() ?>
                                <div class="mb-4">
                                    <?= $this->Form->control('password', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">New Password</h3>', 'escape' => false],
                                        'placeholder' => 'Enter your new password...',
                                        'type' => 'password',
                                        'required' => true,
                                        'minlength' => 8,
                                        'pattern' => "(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}",
                                        'title' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character.',
                                    ]); ?>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('password_confirm', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">Confirm Password</h3>', 'escape' => false],
                                        'placeholder' => 'Re-enter your new password...',
                                        'type' => 'password',
                                        'required' => true,
                                        'minlength' => 8,
                                        'pattern' => "(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}",
                                        'title' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character.',
                                    ]); ?>
                                </div>
                            </fieldset>
                            <div class="text-center">
                                <?= $this->Form->button('Reset Password', ['class' => 'btn btn-primary btn-lg']) ?>
                            </div>
                            <?= $this->Form->end() ?>

                            <hr class="my-4">

                            <div class="text-center">
                                <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'btn btn-link']) ?>
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
