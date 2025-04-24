<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;

$this->assign('title', 'Contact Us');

?>

<?php
$html = new HtmlHelper(new View());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CrunchyCravings</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>

    <!-- Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body>
    <!-- Page Breadcrumb -->
    <!-- container -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Contact Us" href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'ContactUs']) ?>">Contact Us</a></li>
            </ol>
        </div>
    </div><!-- container /- -->
    <!-- Page Breadcrumb /- -->

    <!-- Heading section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h3 class="display-4">Contact Us</h3>
            <p class="lead">We'd love to hear from you! Fill out the form below to get in touch with us.</p>
        </div>
    </section>

    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Contact Form Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div id="form-content">
                            <!-- Allow customized form validation styling -->
                            <?php $this->Form->setTemplates([
                                'inputContainer' => '{{content}}']); ?>
                            <?= $this->Form->create($contact, ['url' => ['controller' => 'Contacts', 'action' => 'contactUs'], 'class'=>'form needs-validation', 'novalidate'=>true]) ?>

                            <div class="mb-4 has-validation">
                                <?= $this->Form->control('first_name', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center"><span style="color: red;">*</span>First Name</h4>', 'escape' => false],
                                    'placeholder' => 'Enter your first name...',
                                    'maxlength' => CONTACT_FIRST_NAME_MAX_LENGTH,
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
                                    'maxlength' => CONTACT_LAST_NAME_MAX_LENGTH,
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
                                    'maxlength' => CONTACT_EMAIL_MAX_LENGTH,
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
                                    'label' => ['text' => '<h4 class="text-center" id="message-label"><span style="color: red;">*</span>Message (<span id="character-count">0</span>/' . CONTACT_MESSAGE_MAX_LENGTH . ')</h4>', 'escape' => false],
                                    'placeholder' => 'Enter your message',
                                    'type' => 'textarea',
                                    'rows' => 5,
                                    'onkeyup' => 'limitInputLength(this, "character-count", ' . CONTACT_MESSAGE_MAX_LENGTH . '); removeScriptTags(this);',
                                    'maxlength' => CONTACT_MESSAGE_MAX_LENGTH, // Override maxlength
                                    'required' => true,
                                ]); ?>
                                <div class="invalid-feedback">Please enter your message.</div>
                            </div>
                            <div class="mb-4">
                                <?= $this->Recaptcha->display() ?>
                            </div>
                            <div class="text-center">
                                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-lg']) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <?= $this->Html->link('Back to Homepage', '/', ['class' => 'btn btn-link']) ?>
            </div>
        </section>
    </div>

    <!-- get the current number of character in message text area -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializeCharacterCount('message', 'character-count');
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <?= $this->Html->script('form-utils') ?>
    <?= $this->Html->script('form-validation') ?>

    </body>

</html>
