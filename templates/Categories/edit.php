<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 * @var \Cake\Collection\CollectionInterface|array<string> $products
 */

use Cake\View\Helper\HtmlHelper;
use Cake\View\View;

?>

<?php
$html = new HtmlHelper(new View());
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - Edit Category</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6">Edit Category</h1>
                <p class="lead">Modify the details of the selected category below.</p>
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
                            <?= $this->Form->create($category, ['class' => 'form needs-validation', 'novalidate' => true]) ?>

                            <div class="mb-4 has-validation">
                                <?= $this->Form->control('name', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4><span style="color: red;">*</span>Category Name</h4>', 'escape' => false],
                                    'placeholder' => 'Enter the category name...',
                                    'pattern' => '^[a-zA-Z\s]+$',
                                    'maxlength' => CATEGORY_NAME_MAX_LENGTH,
                                    'title' => 'Please use only letters and spaces for your category name',
                                    'required' => true,
                                ]) ?>
                                <div class="invalid-feedback">Please use only letters and spaces for your category name.</div>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('description', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center" id="description-label">Description (<span id="character-count">0</span>/' . CATEGORY_DESC_MAX_LENGTH . ')</h4>', 'escape' => false],
                                    'placeholder' => 'Enter a brief description...',
                                    'type' => 'textarea',
                                    'rows' => 4,
                                    'onkeyup' => 'limitInputLength(this, "character-count", ' . CATEGORY_DESC_MAX_LENGTH . ')',
                                    'oninput' => 'removeScriptTags(this)',
                                    'maxlength' => CATEGORY_DESC_MAX_LENGTH, // Override maxlength
                                ]) ?>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('products._ids', [
                                    'type' => 'select',
                                    'label' => ['text' => '<h4>Products</h4>', 'escape' => false],
                                    'options' => $productsList,
                                    'multiple' => true,
                                    'class' => 'form-select select2', // use select2
                                    'empty' => false, // Disable the empty option
                                    'value' => $this->request->getQuery('products._ids'),
                                ]) ?>
                            </div>
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

    <!-- Bootstrap JS -->
    
    <!-- Select2 Initialization -->
    <script>
        jQuery(document).ready(function() {
            jQuery('.select2').select2({
                placeholder: "Select products",
                allowClear: true,
            });
        });
    </script>

    <!-- get the current number of character in description text area -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializeCharacterCount('description', 'character-count');
        });
    </script>

    <!-- Custom JS -->
    <?= $this->Html->script('form-utils') ?>
    <?= $this->Html->script('form-validation') ?>

    <!-- Limit initial input length -->
    <script>
        function waitForElement(selector, callback) {
            const element = document.querySelector(selector);
            if (element) {
                callback(element);
            } else {
                setTimeout(() => waitForElement(selector, callback), 100); // Retry after 100ms-->
            }
        }

        waitForElement('input[name="description"]', function (descriptionInput) {
            limitInputLength(descriptionInput, 'description-label', 'Description', MSG_MAX_LENGTH);
        });
    </script>
</body>
