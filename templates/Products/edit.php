<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var \Cake\Collection\CollectionInterface|array<string> $categories
 */

use Cake\View\Helper\HtmlHelper;
use Cake\View\View;

?>

<?php
$html = new HtmlHelper(new View());
const DESC_MAX_LENGTH = '150';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - Edit Product</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>
</head>

<body>
    <!-- Heading Section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-4">Edit Product</h1>
            <p class="lead">Modify the details of the selected product below.</p>
        </div>
    </section>

    <!-- Edit Form Section -->
    <section id="form-section" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="form-content">
                        <!-- Allow customized form validation styling -->
                        <?php $this->Form->setTemplates([
                            'inputContainer' => '{{content}}']); ?>
                        <?= $this->Form->create($product, ['class' => 'form needs-validation', 'type' => 'file', 'novalidate' => true]) ?>

                        <div class="mb-4 has-validation">
                            <?= $this->Form->control('name', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4><span style="color: red;">*</span>Product Name</h4>', 'escape' => false],
                                'placeholder' => 'Enter the product name...',
                                'pattern' => '^[a-zA-Z\s]+$',
                                'title' => 'Please use only letters and spaces for your product name',
                                'required' => true,
                            ]) ?>
                            <div class="invalid-feedback">Please use only letters and spaces for your product name</div>
                        </div>
                        <div class="mb-4">
                            <?= $this->Form->control('description', [
                                'class' => 'form-control mx-auto',
                                'id' => 'description',
                                'label' => ['text' => '<h4 class="text-center" id="description-label">Description (<span id="character-count">0</span>/' . DESC_MAX_LENGTH . ')</h4>', 'escape' => false],
                                'placeholder' => 'Enter a brief description...',
                                'type' => 'textarea',
                                'rows' => 4,
                                'onkeyup' => 'limitInputLength(this, "character-count", ' . DESC_MAX_LENGTH . ')',
                                'oninput' => 'removeScriptTags(this)',
                                'maxlength' => DESC_MAX_LENGTH, // Override maxlength
                            ]) ?>
                        </div>
                        <div class="mb-4 has-validation">
                            <?= $this->Form->control('price', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4><span style="color: red;">*</span>Price</h4>', 'escape' => false],
                                'type' => 'number',
                                'min' => '0',
                                'max' => '500',
                                'placeholder' => 'Please set your product price...',
                                'required' => true,
                            ]) ?>
                            <div class="invalid-feedback">Product price ranges from 0 to 500</div>
                        </div>
                        <div class="mb-4">
                            <?= $this->Form->control('image', [
                                'type' => 'file',
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4>Image URL</h4>', 'escape' => false],
                            ]) ?>
                        </div>
                        <div class="mb-4 has-validation">
                            <?= $this->Form->control('quantity', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4>Quantity</h4>', 'escape' => false],
                                'type' => 'number',
                                'min' => '0',
                                'max' => '1000',
                                'placeholder' => 'Enter the quantity...',
                                'required' => true,
                            ]) ?>
                            <div class="invalid-feedback">Product quantity ranges from 0 to 100</div>
                        </div>
                        <div class="mb-4 has-validation">
                            <?= $this->Form->control('categories._ids', [
                                'type' => 'select',
                                'label' => ['text' => '<h4><span style="color: red;">*</span>Categories</h4>', 'escape' => false],
                                'options' => $categoriesList,
                                'multiple' => true,
                                'class' => 'form-select select2', // use select2
                                'empty' => false, // Disable the empty option
                                'value' => $this->request->getQuery('categories._ids'),
                                'required' => true,
                            ]) ?>
                            <div class="invalid-feedback">Product should have at least a category</div>
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


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 Initialization -->
    <script>
        jQuery(document).ready(function() {
            jQuery('.select2').select2({
                placeholder: "Select categories",
                allowClear: true,
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializeCharacterCount('description', 'character-count', ' . DESC_MAX_LENGTH . ');
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
                setTimeout(() => waitForElement(selector, callback), 100); // Retry after 100ms
            }
        }

        waitForElement('input[name="description"]', function (descriptionInput) {
            limitInputLength(descriptionInput, 'description-label', 'desc-character-count', ' . DESC_MAX_LENGTH . ');
        });
    </script>
</body>

