<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
?>

<div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid">
                <div class="row">
                    <aside class="column col-lg-3">
                        <div class="side-nav">
                            <h4 class="heading"><?= __('Actions') ?></h4>
                            <?= $this->Html->link(__('Edit Contact'), ['action' => 'edit', $contact->id], ['class' => 'btn btn-warning btn-block mb-3']) ?>
                            <?= $this->Form->postLink(__('Delete Contact'), ['action' => 'delete', $contact->id], [
                                'confirm' => __('Are you sure you want to delete this contact: {0} ({1})?', $contact->full_name, $contact->email),
                                'class' => 'btn btn-danger btn-block mb-3'
                            ]) ?>
                            <?= $this->Html->link(__('List Contacts'), ['action' => 'index'], ['class' => 'btn btn-primary btn-block mb-3']) ?>
                            <?= $this->Html->link(__('New Contact'), ['action' => 'add'], ['class' => 'btn btn-success btn-block mb-3']) ?>
                            <?= $this->Html->link(__('Update Reply Status'), ['action' => 'updateReplyStatus', $contact->id], ['class' => 'btn btn-info btn-block']) ?>
                        </div>
                    </aside>
                    <div class="column col-lg-9">
                        <div class="contacts view content">
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
                            <div class="text">
                                <strong><?= __('Message') ?></strong>
                                <blockquote>
                                    <?= $this->Text->autoParagraph(h($contact->message)); ?>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
