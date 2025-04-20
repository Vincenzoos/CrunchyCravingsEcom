<!-- filepath: c:\xampp\htdocs\team068-onboarding-project\templates\Contacts\view.php -->
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
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'table','form']) ?>

    <?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- View Contact Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-4">View Contact</h1>
                <p class="lead">Details of the selected contact are shown below.</p>
            </div>
        </section>

        <!-- Contact Details Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="form-content" class="text-center">
                            <h3><?= h($contact->first_name) . ' ' . h($contact->last_name) ?></h3>
                            <table class="table table-bordered">
                                <tr>
                                    <th><?= __('First Name') ?></th>
                                    <td><?= h($contact->first_name) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Last Name') ?></th>
                                    <td><?= h($contact->last_name) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Email') ?></th>
                                    <td><?= h($contact->email) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Phone Number') ?></th>
                                    <td><?= h($contact->phone_number) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Date Sent') ?></th>
                                    <td><?= h($contact->date_sent) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Replied') ?></th>
                                    <td><?= $contact->replied ? __('Yes') : __('No'); ?></td>
                                </tr>
                            </table>
							<div id="message-content" class="text-center mt-4">
								<h3><?= __('Description') ?></h3>
								<table class="table table-bordered">
									<tr>
										<td><?= $this->Text->autoParagraph(h($contact->message)); ?></td>
									</tr>
								</table>
							</div>
                        </div>
                        <div class="text-center mt-4">
                            <?= $this->Html->link('Email', 'mailto:' . h($contact->email), ['class' => 'btn btn-dark']) ?>
                            <?= $this->Html->link('Update Reply Status', ['action'=>'updateReplyStatus', $contact->id], ['class' => 'btn btn-info']) ?>
                            <?= $this->Html->link('Edit Contact', ['action' => 'edit', $contact->id], ['class' => 'btn btn-warning']) ?>
                            <?= $this->Form->postLink('Delete Contact', ['action' => 'delete', $contact->id], [
                                'confirm' => __('Are you sure you want to delete this contact: {0} ({1})?', $contact->full_name, $contact->email),
                                'class' => 'btn btn-danger'
                            ]) ?>
                        </div>
                        <div class="text-center mt-4">
                            <?= $this->Html->link('Back to Contacts List', ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!--        <div class="text-center mt-4">-->
<!--            --><?php //= $this->Html->link('Back to Dashboard', '#', ['class' => 'btn btn-link']) ?>
<!--        </div>-->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
