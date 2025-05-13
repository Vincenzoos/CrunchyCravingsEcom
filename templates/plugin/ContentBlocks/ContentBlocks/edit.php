<?php
/**
 * @var \App\View\AppView $this
 * @var \ContentBlocks\Model\Entity\ContentBlock $contentBlock
 */

$this->assign('title', 'Edit Content Block - Content Blocks');

$this->Html->script('ContentBlocks.ckeditor/ckeditor', ['block' => true]);

$this->Html->css(['utilities', 'table', 'form', 'ContentBlocks.content-blocks'], ['block' => true]);
?>

<style>
    .ck-editor__editable_inline {
        min-height: 25rem; /* CKEditor field minimal height */
    }
</style>

<body>
<!-- Page Container -->
<div class="page-container mx-auto my-5">
    <!-- Heading Section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-6">Edit Content Block</h1>
            <p class="lead">Modify the details of the selected content block below.</p>
        </div>
    </section>

    <!-- Edit Form Section -->
    <section id="form-section" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="form-content">
                        <!-- Allow customized form validation styling -->
                        <?= $this->Form->create($contentBlock, ['type' => 'file', 'class' => 'form needs-validation', 'novalidate' => true]) ?>

                        <div class="mb-4">
                            <?= $this->Form->control('label', [
                                'class' => 'form-control',
                                'label' => ['text' => '<h4>Content Block Label</h4>', 'escape' => false],
                                'placeholder' => 'Enter the content block label...',
                                'maxlength' => 255,
                                'required' => true,
                                'disabled' => true,
                            ]) ?>
                        </div>

                        <div class="mb-4">
                            <?= $this->Form->control('description', [
                                'class' => 'form-control',
                                'label' => ['text' => '<h4>Description</h4>', 'escape' => false],
                                'placeholder' => 'Enter a brief description...',
                                'type' => 'textarea',
                                'rows' => 4,
                                'maxlength' => 500,
                                'disabled' => true,
                            ]) ?>
                        </div>

                        <?php
                        if ($contentBlock->type === 'text') {
                            echo $this->Form->control('value', [
                                'type' => 'text',
                                'value' => html_entity_decode($contentBlock->value),
                                'label' => ['text' => '<h4>Content value</h4>', 'escape' => false],
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => 'Enter the content value...',
                                'maxlength' => 255,
                                'title' => 'Content value must not be empty',

                            ]);
                        } elseif ($contentBlock->type === 'html') {
                            echo $this->Form->control('value', [
                                'type' => 'textarea',
                                'id' => 'content-value-input',
                                'label' => ['text' => '<h4>HTML Content</h4>', 'escape' => false],
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => 'Enter the HTML content...',
                            ]);
                            ?>
                            <script>
                                document.addEventListener("DOMContentLoaded", (event) => {
                                    CKSource.Editor.create(
                                        document.getElementById('content-value-input'),
                                        {
                                            toolbar: [
                                                "heading", "|",
                                                "bold", "italic", "underline", "|",
                                                "bulletedList", "numberedList", "|",
                                                "alignment", "blockQuote", "|",
                                                "indent", "outdent", "|",
                                                "link", "|",
                                                "insertTable", "imageInsert", "mediaEmbed", "horizontalLine", "|",
                                                "removeFormat", "|",
                                                "sourceEditing", "|",
                                                "undo", "redo",
                                            ],
                                            simpleUpload: {
                                                uploadUrl: <?= json_encode($this->Url->build(['action' => 'upload'])) ?>,
                                                headers: {
                                                    'X-CSRF-TOKEN': <?= json_encode($this->request->getAttribute('csrfToken')) ?>,
                                                }
                                            }
                                        }
                                    ).then(editor => {
                                        console.log(Array.from(editor.ui.componentFactory.names()));
                                    });
                                });
                            </script>
                            <?php
                        } elseif ($contentBlock->type === 'image') {
                            if ($contentBlock->value) {
                                echo $this->Html->image($contentBlock->value, ['class' => 'content-blocks--image-preview']);
                            }

                            echo $this->Form->control('value', [
                                'type' => 'file',
                                'accept' => 'image/*',
                                'label' => ['text' => 'Content Image', 'escape' => false],
                                'class' => 'form-control',
                            ]);
                        }
                        ?>

                        <div class="text-center mt-4">
                            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary btn-lg']) ?>
                            <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-link']) ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
