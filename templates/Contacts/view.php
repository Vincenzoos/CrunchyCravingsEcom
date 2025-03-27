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
                            <h3><?= __('Add Contact') ?></h3>
                            <?= $this->Form->create($contact) ?>
                            <fieldset>
                                <?php
                                echo $this->Form->control('first_name', ['class' => 'form-control mb-3']);
                                echo $this->Form->control('last_name', ['class' => 'form-control mb-3']);
                                echo $this->Form->control('email', ['class' => 'form-control mb-3']);
                                echo $this->Form->control('phone_number', ['class' => 'form-control mb-3']);
                                echo $this->Form->control('message', ['class' => 'form-control mb-3']);
                                echo $this->Form->control('date_sent', ['class' => 'form-control mb-3']);
                                ?>
                            </fieldset>
                            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-block']) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
