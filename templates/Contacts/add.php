<!-- filepath: c:\xampp\htdocs\team068-onboarding-project\templates\Contacts\add.php -->
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
                            <?= $this->Form->create($contact) ?>

                            <div class="mb-4">
                                <?= $this->Form->control('first_name', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4>First Name</h4>', 'escape' => false],
                                    'placeholder' => 'Enter the first name...',
                                    'required' => true,
                                ]); ?>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('last_name', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4>Last Name</h4>', 'escape' => false],
                                    'placeholder' => 'Enter the last name...',
                                    'required' => true,
                                ]); ?>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('email', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4>Email</h4>', 'escape' => false],
                                    'placeholder' => 'Enter the email...',
                                    'type' => 'email',
                                    'required' => true,
                                ]); ?>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('phone_number', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4>Phone Number</h4>', 'escape' => false],
                                    'placeholder' => 'Enter the phone number...',
                                    'type' => 'tel',
                                    'required' => true,
                                ]); ?>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('message', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4>Message</h4>', 'escape' => false],
                                    'placeholder' => 'Enter the message...',
                                    'type' => 'textarea',
                                    'rows' => 5,
                                    'required' => true,
                                ]); ?>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('date_sent', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4>Date Sent</h4>', 'escape' => false],
                                    'type' => 'date',
                                    'required' => true,
                                ]); ?>
                            </div>
                            <div class="text-center">
                                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-lg']) ?>
                            </div>
                            <div class="text-center mt-4">
                                <?= $this->Html->link('View Contacts List', ['controller' => 'Contacts', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <?= $this->Html->link('Back to Dashboard', '#', ['class' => 'btn btn-link']) ?>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
