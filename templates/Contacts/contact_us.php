<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
$this->assign('title', 'Contact Us');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h1 class="text-center mb-4">Contact Us</h1>
        </div>
    </aside>
    <div class="column column-80">
        <div class="contacts form content">
            <?= $this->Form->create($contact, ['url' => ['controller' => 'Contacts', 'action' => 'contactUs']]) ?>

            <div class="mb-3">
                <?= $this->Form->control('first_name', [
                    'class' => 'form-control',
                    'label' => false,
                    'placeholder' => 'Enter your first name...',
                    'required' => true,
                ]); ?>
            </div>
            <div class="mb-3">
                <?= $this->Form->control('last_name', [
                    'class' => 'form-control',
                    'label' => false,
                    'placeholder' => 'Enter your last name...',
                    'required' => true,
                ]); ?>
            </div>
            <div class="mb-3">
                <?= $this->Form->control('email', [
                    'class' => 'form-control',
                    'label' => false,
                    'placeholder' => 'Enter your email (e.g., abc@example.com)',
                    'type' => 'email',
                    'required' => true,
                ]); ?>
            </div>
            <div class="mb-3">
                <?= $this->Form->control('phone_number', [
                    'class' => 'form-control',
                    'label' => false,
                    'placeholder' => 'Enter your phone number (e.g., 0452 452 234)',
                    'type' => 'tel',
                    'pattern' => '^0[1-9]\d{0,2} \d{3} \d{3}$',
                    'title' => 'Please enter a valid phone number starting with 0 (e.g., 0411 256 454).',
                    'required' => true,
                ]); ?>
            </div>
            <div class="mb-3">
                <?= $this->Form->control('message', [
                    'class' => 'form-control',
                    'label' => false,
                    'placeholder' => 'Enter your message',
                    'type' => 'textarea',
                    'rows' => 5,
                    'required' => true,
                ]); ?>
            </div>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
