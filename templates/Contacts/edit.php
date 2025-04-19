<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
?>

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
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
        <!-- Edit Contact Section -->
        <section id="heading" class="text-center py-5">
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
                        <div id="form-content">
                            <?= $this->Form->create($contact) ?>
                            <fieldset>
                                <div class="mb-4">
                                    <?= $this->Form->control('first_name', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h4>First Name</h4>', 'escape' => false],
                                        'placeholder' => 'Enter the first name...',
                                        'required' => true,
                                    ]) ?>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('last_name', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h4>Last Name</h4>', 'escape' => false],
                                        'placeholder' => 'Enter the last name...',
                                        'required' => true,
                                    ]) ?>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('email', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h4>Email</h4>', 'escape' => false],
                                        'placeholder' => 'Enter the email...',
                                        'type' => 'email',
                                        'required' => true,
                                    ]) ?>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('phone_number', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h4 class="text-center">Phone Number</h4>', 'escape' => false],
                                        'placeholder' => 'Enter your phone number (e.g., 0452 452 234)',
                                        'type' => 'tel',
                                        'pattern' => '^0[1-9]\d{0,2} \d{3} \d{3}$',
                                        'title' => 'Please enter a valid phone number starting with 0 (e.g., 0411 256 454).',
                                        'onkeyup' => 'this.value = formatPhoneNumber(this.value)',
                                        'required' => true,
                                    ]); ?>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('message', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h4 class="text-center" id="message-label">Message (0/150)</h4>', 'escape' => false],
                                        'placeholder' => 'Enter your message',
                                        'type' => 'textarea',
                                        'rows' => 5,
                                        'onkeyup' => 'limitInputLength(this, "message-label", "Message", 150)',
                                        'oninput' => 'removeScriptTags(this)',
                                        'maxlength' => 150, // Override maxlength
                                        'required' => true,
                                    ]); ?>
                                </div>
                                <div class="mb-4">
                                    <h4>Replied</h4>
                                    <div class="form-check">
                                        <?= $this->Form->control('replied', [
                                            'class' => 'form-check-input',
                                            'type' => 'checkbox',
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <?= $this->Form->control('date_sent', [
                                        'class' => 'form-control mx-auto',
                                        'label' => ['text' => '<h4>Date Sent</h4>', 'escape' => false],
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

    <!-- Custom JS -->
    <?= $this->Html->script('form-utils') ?>
    <!-- Limit initial input length -->
    <script>
        function waitForElement(selector, callback) {
            const element = document.querySelector(selector);
            if (element) {
                callback(element);
            } else {
                setTimeout(() => waitForElement(selector, callback), 100); // Retry after 100ms
            }
        }

        waitForElement('input[name="message"]', function (messageInput) {
            limitInputLength(messageInput, 'message-label', 'Message', 150);
        });
    </script>
</body>
