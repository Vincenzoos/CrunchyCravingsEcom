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
    <?= $this->Html->css(['utilities', 'form']) ?>

    <?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Reset Password Section -->
        <section id="reset-password" class="text-center py-5">
            <div class="container">
                <h1 class="display-6">Reset Password</h1>
                <p class="lead">Enter your new password below.</p>
            </div>
        </section>

        <!-- Reset Password Form Section -->
        <section id="reset-password-form" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="users-form-content" id="form-content">
                            <?= $this->Form->create($user) ?>
                            <!--  Set password to none prevent current hashed_password to get pre-populated into the password field by CakePHP Form helper -->
                            <?= $user->password = ''; ?>
                            <fieldset>
                                <legend class="mb-4">Reset Your Password</legend>
                                <?= $this->Flash->render() ?>
                                <!-- Password Requirements-->
                                <div class="mb-4">
                                    <h3>Password</h3>
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

    <!-- Passsword requirements script -->
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
</body>

</html>
