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
    <!-- Max length of below fields shouldn't be changed since they are restricted in the plugin    -->
<!--    TODO: Cannot overwrite file with new js script, therefore cannot use removeScriptTags-->
    <section id="form-section" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="form-content">
                        <?= $this->Form->create($contentBlock, ['type' => 'file']) ?>

                        <div class="mb-4">
                            <?= $this->Form->control('label', [
                                'class' => 'form-control',
                                'label' => ['text' => '<h4>Content Block Label</h4>', 'escape' => false],
                                'placeholder' => 'Enter the content block label...',
                                'maxlength' => 255,
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

                        <div class="mb-4">
                            <?php
                            if ($contentBlock->type === 'text') {
                                echo $this->Form->control('value', [
                                    'type' => 'text',
                                    'value' => html_entity_decode($contentBlock->value),
                                    'label' => ['text' => '<h4><span style="color: red;">*</span>Content value</h4>', 'escape' => false],
                                    'class' => 'form-control',
                                    'required' => true,
                                    'placeholder' => 'Enter the content value...',
                                    'maxlength' => 255,
                                    'title' => 'Invalid input: tags or angle brackets (<, >) are not allowed here.',
                                    'pattern' => '^[^<>]+$',

                                ]);
                            } elseif ($contentBlock->type === 'html') {
                                echo $this->Form->control('value', [
                                    'type' => 'textarea',
                                    'id' => 'content-value-input',
                                    'label' => ['text' => '<h4><span style="color: red;">*</span>HTML Content</h4>', 'escape' => false],
                                    'class' => 'form-control',
                                    'required' => true,
                                    'placeholder' => 'Enter the HTML content...',
                                ]);
                                ?>
                                <?php
                            } elseif ($contentBlock->type === 'image') {
                                if ($contentBlock->value) {
                                    echo $this->Html->image($contentBlock->value, ['class' => 'content-blocks--image-preview']);
                                }
                                echo $this->Form->control('value', [
                                    'type' => 'file',
                                    'accept' => 'image/*',
                                    'label' => ['text' => '<h4><span style="color: red;">*</span>Content Image</h4>', 'escape' => false],
                                    'class' => 'form-control',
                                    'required' => true,
                                    'title' => 'Please select an image file',
                                ]);
                            }
                            ?>
                        </div>


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

<!-- Load CKEditor. -->
<script>
    /*
   Create our CKEditor instance in a DOMContentLoaded event callback, to ensure
   the library is available when we call `create()`.
   Fixes https://github.com/ugie-cake/cakephp-content-blocks/issues/4.
   */
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
</body>
