<!-- filepath: c:\xampp\htdocs\team068-onboarding-project\templates\Auth\register.php -->
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->assign('title', 'Register New User');
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
        <!-- Register Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6">Register</h1>
                <p class="lead">Create a new account below.</p>
            </div>
        </section>

        <!-- Register Form Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div id="form-content">
                            <?= $this->Form->create($user) ?>
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
                                    <!-- Password Requirements-->
                                    <h3>Password</h3>
                                    <div id="requirements-content">
                                        <ul>
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
                                <div class="mb-4" style="margin-top: 25px;">
                                    <?= $this->Form->control('password_confirm', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">Confirm Password</h3>', 'escape' => false],
                                        'placeholder' => 'Re-enter your password...',
                                        'type' => 'password',
                                        'minlength' => 8,
                                        'pattern' => "(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}",
                                        'title' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character.',
                                        'required' => true,
                                    ]); ?>
                                </div>
                            </fieldset>
                            <div class="text-center">
                                <?= $this->Form->button('Register', ['class' => 'btn btn-primary btn-lg']) ?>
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
