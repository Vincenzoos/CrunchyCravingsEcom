<!-- filepath: c:\xampp\htdocs\team068-onboarding-project\templates\Contacts\add.php -->
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
const MSG_MAX_LENGTH = 150;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>

    <?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Add Contact Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-4">Add Contact</h1>
                <p class="lead">Create a new contact below.</p>
            </div>
        </section>

        <!-- Add Contact Form Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="form-content">
                            <!-- Allow customized form validation styling -->
                            <?php $this->Form->setTemplates([
                                'inputContainer' => '{{content}}']); ?>
                            <?= $this->Form->create($contact, ['class' => 'form needs-validation', 'novalidate' => true]) ?>

                            <div class="mb-4 has-validation">
                                <?= $this->Form->control('first_name', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center"><span style="color: red;">*</span>First Name</h4>', 'escape' => false],
                                    'placeholder' => 'Enter your first name...',
                                    'maxlength' => 20,
                                    'required' => true,
                                    'pattern' => '^[a-zA-Z\s]+$',
                                    'title' => 'Please use only letters and spaces for your first name',
                                ]); ?>
                                <div class="invalid-feedback">Please use only letters and spaces for your first name.</div>
                            </div>
                            <div class="mb-4 has-validation">
                                <?= $this->Form->control('last_name', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center"><span style="color: red;">*</span>Last Name</h4>', 'escape' => false],
                                    'placeholder' => 'Enter your last name...',
                                    'maxlength' => 20,
                                    'required' => true,
                                    'pattern' => '^[a-zA-Z\s]+$',
                                    'title' => 'Please use only letters and spaces for your last name',
                                ]); ?>
                                <div class="invalid-feedback">Please use only letters and spaces for your last name.</div>
                            </div>
                            <div class="mb-4 has-validation">
                                <?= $this->Form->control('email', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center"><span style="color: red;">*</span>Email</h4>', 'escape' => false],
                                    'placeholder' => 'Enter your email (e.g., abc@example.com)',
                                    'type' => 'email',
                                    'maxlength' => 40,
                                    'required' => true,
                                ]); ?>
                                <div class="invalid-feedback">Please enter a valid email in the correct format (e.g., abc@example.com).</div>
                            </div>
                            <div class="mb-4 has-validation">
                                <?= $this->Form->control('phone_number', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center"><span style="color: red;">*</span>Phone Number</h4>', 'escape' => false],
                                    'placeholder' => 'Enter your phone number (e.g., 0452 452 234)',
                                    'type' => 'tel',
                                    'pattern' => '^0[1-9]\d{0,2} \d{3} \d{3}$',
                                    'title' => 'Please enter a valid phone number starting with 0 (e.g., 0411 256 454).',
                                    'onkeyup' => 'this.value = formatPhoneNumber(this.value)',
                                    'required' => true,
                                ]); ?>
                                <div class="invalid-feedback">Please enter a valid phone number starting with 0 (e.g., 0411 256 454).</div>
                            </div>
                            <div class="mb-4 has-validation">
                                <?= $this->Form->control('message', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center" id="message-label"><span style="color: red;">*</span>Message (<span id="character-count">0</span>/' . MSG_MAX_LENGTH . ')</h4>', 'escape' => false],
                                    'placeholder' => 'Enter your message',
                                    'type' => 'textarea',
                                    'rows' => 5,
                                    'onkeyup' => 'limitInputLength(this, "character-count", ' . MSG_MAX_LENGTH . '); removeScriptTags(this);',
                                    'maxlength' => MSG_MAX_LENGTH, // Override maxlength
                                    'required' => true,
                                ]); ?>
                                <div class="invalid-feedback">Please enter your message.</div>
                            </div>
                            <div class="mb-4 has-validation">
                                <?= $this->Form->control('date_sent', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4>Date Sent</h4>', 'escape' => false],
                                    'type' => 'date',
                                    'required' => true,
                                    'value' => date('d-m-Y'),
                                ]); ?>
                                <div class="invalid-feedback">Please select a date.</div>
                            </div>
                            <div class="text-center">
                                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-lg']) ?>
                                <?= $this->Html->link('Cancel', ['controller' => 'Contacts', 'action' => 'index'], ['class' => 'btn btn-link']) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="text-center mt-4">-->
<!--                --><?php //= $this->Html->link('Back to Dashboard', '#', ['class' => 'btn btn-link']) ?>
<!--            </div>-->
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <?= $this->Html->script('form-utils') ?>
    <?= $this->Html->script('form-validation') ?>

</body>
