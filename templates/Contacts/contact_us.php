<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
$this->assign('title', 'Contact Us');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CrunchyCravings</title>
    
    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>

    <!-- Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
            <div class="return-home-link pull-right">
                <a title="Return to home page" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">return to home page</a>
            </div>
        </div>
    </div><!-- container /- -->
    <!-- Page Breadcrumb /- -->
     
    <!-- Heading section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-4">Contact Us</h3>
            <p class="lead">We'd love to hear from you! Fill out the form below to get in touch with us.</p>
        </div>
    </section>

    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Contact Form Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="form-content">
                            <?= $this->Form->create($contact, ['url' => ['controller' => 'Contacts', 'action' => 'contactUs']]) ?>

                            <div class="mb-4">
                                <?= $this->Form->control('first_name', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center">First Name</h4>', 'escape' => false],
                                    'placeholder' => 'Enter your first name...',
                                    'required' => true,
                                ]); ?>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('last_name', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center">Last Name</h4>', 'escape' => false],
                                    'placeholder' => 'Enter your last name...',
                                    'required' => true,
                                ]); ?>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('email', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center">Email</h4>', 'escape' => false],
                                    'placeholder' => 'Enter your email (e.g., abc@example.com)',
                                    'type' => 'email',
                                    'required' => true,
                                ]); ?>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('phone_number', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center">Phone Number</h4>', 'escape' => false],
                                    'placeholder' => 'Enter your phone number (e.g., 0452 452 234)',
                                    'type' => 'tel',
                                    'pattern' => '^0[1-9]\d{0,2} \d{3} \d{3}$',
                                    'title' => 'Please enter a valid phone number starting with 0 (e.g., 0411 256 454).',
                                    'required' => true,
                                ]); ?>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('message', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center">Message</h4>', 'escape' => false],
                                    'placeholder' => 'Enter your message',
                                    'type' => 'textarea',
                                    'rows' => 5,
                                    'required' => true,
                                ]); ?>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
