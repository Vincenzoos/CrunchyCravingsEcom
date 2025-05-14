<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->assign('title', 'Change Password');
?>


<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>


    <?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body>
    <!-- Page Breadcrumb -->
    <!-- container -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->App->appUrl(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Forgot password" href="<?= $this->App->appUrl(['controller' => 'Auth', 'action' => 'changePassword']) ?>">Change Password</a></li>
            </ol>
        </div>
    </div><!-- container /- -->
    <!-- Page Breadcrumb /- -->

    <!-- Change Password Section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-6">Change Password</h1>
            <p class="lead">Update your password below.</p>
        </div>
    </section>

    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Change Password Form Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div id="form-content" class="users-form-content">
                            <?= $this->Form->create($user) ?>
                            <!--  Set password to none prevent current hashed_password to get pre-populated into the password field by CakePHP Form helper -->
                            <?= $user->password = ''; ?>
                            <fieldset>
                                <?= $this->Flash->render() ?>
                                <!-- Regular Password Field -->
                                <div class="mb-4">
                                    <h3>Password</h3>
                                    <div id="requirements-content">
                                        <ul>
                                            <li><i class="fa fa-times text-danger" id="length-icon"></i> Must be at least 8 characters long</li>
                                            <li><i class="fa fa-times text-danger" id="uppercase-icon"></i> Must contain at least one uppercase letter</li>
                                            <li><i class="fa fa-times text-danger" id="number-icon"></i> Must contain at least one number</li>
                                            <li><i class="fa fa-times text-danger" id="special-icon"></i> Must contain at least one special character (e.g., @$!%*?&)</li>
                                        </ul>
                                    </div>
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

                                <!-- Confirm Password Field -->
                                <div class="mb-4">
                                    <h3 class="text-center">Confirm Password</h3>
                                    <div class="position-relative">
                                        <?= $this->Form->control('password_confirm', [
                                            'class' => 'form-control mx-auto',
                                            'label' => false,
                                            'placeholder' => 'Retype your new password...',
                                            'type' => 'password',
                                            'id' => 'confirm-password-field',
                                            'minlength' => 8,
                                            'pattern' => "(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}",
                                            'title' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character.',
                                            'required' => true,
                                        ]); ?>
                                        <span toggle="#confirm-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
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

    <!-- Passsword requirements script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const passwordInput = document.getElementById('password-field');
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
</body>

</html>
