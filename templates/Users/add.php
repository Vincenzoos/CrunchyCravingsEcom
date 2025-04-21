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
    <title>CrunchyCravings - Add User</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>
</head>

<body>
    <!-- Heading Section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-4">Add User</h1>
            <p class="lead">Fill out the form below to add a new user.</p>
        </div>
    </section>

    <!-- Add Form Section -->
    <section id="form-section" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="form-content" class="bg-light p-4 rounded">
                        <?= $this->Form->create($user, ['class' => 'form']) ?>

                        <div class="mb-4">
                            <?= $this->Form->control('email', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4><span style="color: red;">*</span>Email</h4>', 'escape' => false],
                                'placeholder' => 'Enter the user email...',
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="mb-4">
                            <?= $this->Form->control('password', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4><span style="color: red;">*</span>Password</h4>', 'escape' => false],
                                'placeholder' => 'Enter a password...',
                                'type' => 'password',
                                'minlength' => 8,
                                'pattern' => "(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}",
                                'title' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character.',
                                'required' => true,
                            ]) ?>
                        </div>
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
</body>
