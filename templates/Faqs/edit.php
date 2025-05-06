<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq $faq
 */

use Cake\View\Helper\HtmlHelper;
use Cake\View\View;

$html = new HtmlHelper(new View());
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - Edit FAQ</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>

    <!-- TinyMCE install -->
    <script src="https://cdn.tiny.cloud/1/o7rovczxwndgnaktevj0ua3mivy00y82kufvg33rz8kqgkkw/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6">Edit FAQ</h1>
                <p class="lead">Modify the details of the selected FAQ below.</p>
            </div>
        </section>

        <!-- Edit Form Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div id="form-content">
                            <!-- Allow customized form validation styling -->
                            <?php $this->Form->setTemplates([
                                'inputContainer' => '{{content}}']); ?>
                            <?= $this->Form->create($faq, ['class' => 'form needs-validation', 'novalidate' => true]) ?>

                            <!-- Title Field -->
                            <div class="mb-4 has-validation">
                                <?= $this->Form->control('title', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4><span style="color: red;">*</span>Title</h4>', 'escape' => false],
                                    'placeholder' => 'Enter the FAQ title...',
                                    'maxlength' => 255,
                                    'required' => true,
                                ]) ?>
                                <div class="invalid-feedback">Please provide a title for the FAQ.</div>
                            </div>

                            <!-- Answer Field -->
                            <div class="mb-4">
                                <?= $this->Form->control('answer', [
                                    'type' => 'textarea',
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4><span style="color: red;">*</span>Answer</h4>', 'escape' => false],
                                    'placeholder' => 'Enter the FAQ answer...',
                                    'rows' => 6,
                                    'required' => true,
                                ]) ?>
                                <div class="invalid-feedback">Please provide an answer for the FAQ.</div>
                            </div>

                            <!-- Submit and Cancel Buttons -->
                            <div class="text-center">
                                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-lg']) ?>
                                <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-link']) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- TinyMCE Initialization -->
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
            // Core editing features
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
            ],
        });
    </script>

    <!-- Custom JS -->
    <?= $this->Html->script('form-validation') ?>
</body>