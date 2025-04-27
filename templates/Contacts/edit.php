<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
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
    <title>CrunchyCravings - Edit Contact</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6">Edit Contact</h1>
                <p class="lead">Update the contact details below.</p>
            </div>
        </section>

        <!-- Edit Form Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div id="form-content" class="row justify-content-center">
                    
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <?= $this->Form->create($contact, ['class' => 'form needs-validation', 'novalidate' => true]) ?>
                        <div class="mb-4 has-validation">
                            <?= $this->Form->control('first_name', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4><span style="color: red;">*</span>First Name</h4>', 'escape' => false],
                                'placeholder' => 'Enter the first name...',
                                'pattern' => '^[a-zA-Z\s]+$',
                                'maxlength' => 50,
                                'title' => 'Please use only letters and spaces for the first name',
                                'required' => true,
                            ]) ?>
                            <div class="invalid-feedback">Please use only letters and spaces for the first name</div>
                        </div>

                        <div class="mb-4 has-validation">
                            <?= $this->Form->control('last_name', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4><span style="color: red;">*</span>Last Name</h4>', 'escape' => false],
                                'placeholder' => 'Enter the last name...',
                                'pattern' => '^[a-zA-Z\s]+$',
                                'maxlength' => 50,
                                'title' => 'Please use only letters and spaces for the last name',
                                'required' => true,
                            ]) ?>
                            <div class="invalid-feedback">Please use only letters and spaces for the last name</div>
                        </div>

                        <div class="mb-4 has-validation">
                            <?= $this->Form->control('email', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4><span style="color: red;">*</span>Email</h4>', 'escape' => false],
                                'placeholder' => 'Enter the email address...',
                                'type' => 'email',
                                'maxlength' => 100,
                                'required' => true,
                            ]) ?>
                            <div class="invalid-feedback">Please enter a valid email address</div>
                        </div>

                        <div class="mb-4">
                            <?= $this->Form->control('phone_number', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4>Phone Number</h4>', 'escape' => false],
                                'placeholder' => 'Enter the phone number...',
                                'type' => 'tel',
                                'pattern' => '^[0-9\s\-\+\(\)]+$',
                                'maxlength' => 15,
                                'title' => 'Please enter a valid phone number',
                            ]) ?>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <?= $this->Form->control('message', [
                                'class' => 'form-control mx-auto',
                                'id' => 'message',
                                'label' => ['text' => '<h4 class="text-center" id="message-label">Message (<span id="character-count">0</span>/500)</h4>', 'escape' => false],
                                'placeholder' => 'Enter the message...',
                                'type' => 'textarea',
                                'rows' => 6,
                                'maxlength' => 500,
                                'onkeyup' => 'limitInputLength(this, "character-count", 500)',
                                'oninput' => 'removeScriptTags(this)',
                                'required' => true,
                            ]) ?>
                            <div class="invalid-feedback">Please enter your message</div>
                        </div>
                        <h4>Mark as Replied</h4>
                        <div class="mb-4 has-validation">
                            <?= $this->Form->control('replied', [
                                'type' => 'checkbox',
                                'label' => false,
                                'escape' => false,
                                'checked' => $contact->replied,
                            ]) ?>
                        </div>

                        <div class="mb-4 has-validation">
                            <?= $this->Form->control('date_sent', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4><span style="color: red;">*</span>Date Sent</h4>', 'escape' => false],
                                'type' => 'date',
                                'required' => true,
                                'value' => $contact->date_sent ? $contact->date_sent->format('Y-m-d') : date('Y-m-d'),
                            ]) ?>
                            <div class="invalid-feedback">Please select a date</div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-lg']) ?>
                        <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-link']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <?= $this->Html->script('form-utils') ?>
    <?= $this->Html->script('form-validation') ?>
</body>