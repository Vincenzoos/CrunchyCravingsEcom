<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq $faq
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $faq->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $faq->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Faqs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="faqs form content">
            <?= $this->Form->create($faq) ?>
            <fieldset>
                <legend><?= __('Edit Faq') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('answer');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <!-- Install and include TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link lists code',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link code',
            menubar: false
        });
    </script>
</div>


