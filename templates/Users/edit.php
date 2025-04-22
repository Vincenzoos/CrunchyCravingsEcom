<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

use Cake\View\Helper\HtmlHelper;
use Cake\View\View;

?>

<?php
$html = new HtmlHelper(new View());
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - Edit User</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>
</head>

<body>
    <!-- Heading Section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-4">Edit User</h1>
            <p class="lead">Modify the details of the selected user below.</p>
        </div>
    </section>

    <!-- Edit Form Section -->
    <section id="form-section" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div id="form-content">
                        <?= $this->Form->create($user, [
                            'class' => 'form',
                        ]) ?>
                        <!--  Set password to none prevent current hashed_password to get pre-populated into the password field by CakePHP Form helper -->
                        <?= $user->password = ''; ?>
                        <div class="mb-4">
                            <?= $this->Form->control('email', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4><span style="color: red;">*</span>Email</h4>', 'escape' => false],
                                'placeholder' => 'Enter the user email...',
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="mb-4">
                            <div class="form-check">
                                <?= $this->Form->control('change_password', [
                                    'class' => 'form-check-input',
                                    'label' => ['text' => '<h4>Change Password</h4>', 'escape' => false],
                                    'type' => 'checkbox',
                                    'id' => 'change-password-checkbox',
                                ]) ?>
                            </div>
                        </div>
                        <div class="mb-4 new-password-container" style="display: none;">
                            <?= $this->Form->control('password', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4>New Password</h4>', 'escape' => false],
                                'placeholder' => 'Enter a new password...',
                                'type' => 'password',
                                'minlength' => 8,
                                'pattern' => "(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}",
                                'title' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character.',
                                'required' => false, // Optional for editing
                            ]) ?>

                        </div>
<!--                        <div class="mb-4 new-password-container" style="display: none;">-->
<!--                            --><?php //= $this->Form->control('password_confirm', [
//                                'class' => 'form-control mx-auto',
//                                'label' => ['text' => '<h4><span style="color: red;">*</span>Confirm Password</h4>', 'escape' => false],
//                                'placeholder' => 'Retype your new password...',
//                                'type' => 'password',
//                                'pattern' => "(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}",
//                                'title' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character.',
//                                'required' => false,
//                            ]); ?>
<!--                        </div>-->
                        <div class="mb-4">
                            <?= $this->Form->control('role', [
                                'type' => 'select',
                                'label' => ['text' => '<h4><span style="color: red;">*</span>Role</h4>', 'escape' => false],
                                'options' => ['admin' => 'Admin', 'customer' => 'Customer'],
                                'class' => 'form-select select2',
                                'empty' => false, // Disable the empty option
                                'default' => 'customer',
                            ]) ?>
                        </div>
                        <div class="text-center">
                            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-lg']) ?>
                            <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-link']) ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 Initialization -->
    <script>
        jQuery(document).ready(function() {
            jQuery('.select2').select2({
                placeholder: "Select a role",
                allowClear: true,
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('change-password-checkbox');
            const passwordContainers = document.getElementsByClassName('new-password-container');

            checkbox.addEventListener('change', function () {
                for (let i = 0; i < passwordContainers.length; i++) {
                    const input = passwordContainers[i].querySelector('input');
                    if (checkbox.checked) {
                        // Show the password fields and ensure inputs are enabled
                        passwordContainers[i].style.display = 'block';
                        passwordContainers[i] = 'block';
                    } else {
                        // Hide the password fields and clear the input value
                        passwordContainers[i].style.display = 'none';
                        input.value = "";
                    }
                }
            });
            // Trigger change event on page load to set the correct state
            checkbox.dispatchEvent(new Event('change'));
        });
    </script>
</body>
