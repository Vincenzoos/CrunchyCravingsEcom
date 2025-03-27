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
                            <?= $this->Html->link(__('List Contacts'), ['action' => 'index'], ['class' => 'btn btn-primary btn-block mb-3']) ?>
                        </div>
                    </aside>
                    <div class="column col-lg-9">
                        <div class="contacts form content">
                            <?= $this->Form->create($contact) ?>
                            <fieldset>
                                <legend><?= __('Add Contact') ?></legend>
                                <div class="form-group">
                                    <?= $this->Form->control('first_name', ['class' => 'form-control', 'label' => 'First Name']) ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->control('last_name', ['class' => 'form-control', 'label' => 'Last Name']) ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->control('email', ['class' => 'form-control', 'label' => 'Email']) ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->control('phone_number', ['class' => 'form-control', 'label' => 'Phone Number']) ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->control('message', ['class' => 'form-control', 'label' => 'Message', 'rows' => 4]) ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->control('date_sent', ['class' => 'form-control', 'label' => 'Date Sent', 'type' => 'date']) ?>
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-block']) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
