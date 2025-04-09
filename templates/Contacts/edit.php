<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <?= $this->Html->css(['style', 'table', 'contact_us']) ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Heading Banner -->
        <section id="heading-banner">
            <header id="heading-inner" class="text-center py-3">
                <?= $this->Html->image('cc_logo.png', ['class' => 'img-fluid', 'alt' => 'CrunchyCravings']) ?>
            </header>
        </section>

        <!-- Edit Contact Section -->
        <section id="heading-section" class="text-center py-5">
            <div class="container">
                <h1 class="display-4">Edit Contact</h1>
                <p class="lead">Update the contact details below.</p>
            </div>
        </section>

        <!-- Add Contact Form Section -->
        <section id="form-section" class="py-5">
            <!-- Main Content -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="form-content" class="text-center">
                            <?= $this->Form->create($contact) ?>
                            <fieldset>
                                <div class="mb-4">
                                    <?= $this->Form->control('first_name', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">First Name</h3>', 'escape' => false],
                                        'placeholder' => 'Enter the first name...',
                                        'required' => true,
                                    ]) ?>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('last_name', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">Last Name</h3>', 'escape' => false],
                                        'placeholder' => 'Enter the last name...',
                                        'required' => true,
                                    ]) ?>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('email', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">Email</h3>', 'escape' => false],
                                        'placeholder' => 'Enter the email...',
                                        'type' => 'email',
                                        'required' => true,
                                    ]) ?>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('phone_number', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">Phone Number</h3>', 'escape' => false],
                                        'placeholder' => 'Enter the phone number...',
                                        'type' => 'tel',
                                        'required' => true,
                                    ]) ?>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('message', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">Message</h3>', 'escape' => false],
                                        'placeholder' => 'Enter the message...',
                                        'type' => 'textarea',
                                        'rows' => 5,
                                    ]) ?>
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <?= $this->Form->control('replied', [
                                            'class' => 'form-check-input',
                                            'label' => ['text' => '<h3 class="text-center">Replied</h3>', 'escape' => false],
                                            'type' => 'checkbox',
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('date_sent', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h3 class="text-center">Date Sent</h3>', 'escape' => false],
                                        'type' => 'date',
                                        'required' => true,
                                    ]) ?>
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-block']) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                        <div class="text-center mt-4">
                            <?= $this->Form->postLink('Delete Contact', ['action' => 'delete', $contact->id], [
                                'confirm' => __('Are you sure you want to delete this contact: {0} ({1})?', $contact->full_name, $contact->email),
                                'class' => 'btn btn-danger'
                            ]) ?>
                            <?= $this->Html->link('Add New Contact', ['action' => 'add'], ['class' => 'btn btn-success']) ?>
                        </div>
                        <div class="text-center mt-4">
                            <?= $this->Html->link('View Contacts List', ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
                        </div>
                        <div class="text-center mt-4">
                            <?= $this->Html->link('Back to Dashboard', '#', ['class' => 'btn btn-link']) ?>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
