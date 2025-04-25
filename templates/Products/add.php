<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var \Cake\Collection\CollectionInterface|array<string> $allCategories
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
    <title>CrunchyCravings - Add Product</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">
        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6">Add Product</h1>
                <p class="lead">Fill out the form below to add a new product.</p>
            </div>
        </section>

        <!-- Add Form Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="form-content">
                            <!-- Allow customized form validation styling -->
                            <?php $this->Form->setTemplates([
                                'inputContainer' => '{{content}}']); ?>
                            <?= $this->Form->create($product, ['class' => 'form needs-validation', 'type' => 'file', 'novalidate' => true]) ?>

                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="mb-4 has-validation">
                                        <?= $this->Form->control('name', [
                                            'class' => 'form-control mx-auto',
                                            'label' => ['text' => '<h4><span style="color: red;">*</span>Product Name</h4>', 'escape' => false],
                                            'placeholder' => 'Enter the product name...',
                                            'pattern' => '^[a-zA-Z\s]+$',
                                            'maxlength' => PRODUCT_NAME_MAX_LENGTH,
                                            'title' => 'Please use only letters and spaces for your product name',
                                            'required' => true,
                                        ]) ?>
                                        <div class="invalid-feedback">Please use only letters and spaces for your product name</div>
                                    </div>

                                    <div class="mb-4">
                                        <?= $this->Form->control('description', [
                                            'class' => 'form-control mx-auto',
                                            'id' => 'description',
                                            'label' => ['text' => '<h4 class="text-center" id="description-label">Description (<span id="desc-character-count">0</span>/' . PRODUCT_DESC_MAX_LENGTH . ')</h4>', 'escape' => false],
                                            'placeholder' => 'Enter a brief description...',
                                            'type' => 'textarea',
                                            'rows' => 4,
                                            'onkeyup' => 'limitInputLength(this, "desc-character-count", ' . PRODUCT_DESC_MAX_LENGTH . ')',
                                            'oninput' => 'removeScriptTags(this)',
                                            'maxlength' => PRODUCT_DESC_MAX_LENGTH,
                                        ]) ?>
                                    </div>

                                    <div class="mb-4">
                                        <?= $this->Form->control('ingredients', [
                                            'class' => 'form-control mx-auto',
                                            'id' => 'ingredients',
                                            'label' => ['text' => '<h4 class="text-center" id="ingredients-label">Ingredients (<span id="ingr-character-count">0</span>/' . PRODUCT_INGREDIENTS_MAX_LENGTH . ')</h4>', 'escape' => false],
                                            'placeholder' => 'List out the ingredients...',
                                            'type' => 'textarea',
                                            'pattern' => '^[A-Za-z0-9%.,() ]+$',
                                            'title' => 'Only letters, numbers, spaces, parenthesis and percentage sign are allowed.',
                                            'rows' => 4,
                                            'onkeyup' => 'limitInputLength(this, "ingr-character-count", ' . PRODUCT_INGREDIENTS_MAX_LENGTH . ')',
                                            'oninput' => 'removeScriptTags(this)',
                                            'maxlength' => PRODUCT_INGREDIENTS_MAX_LENGTH,
                                        ]) ?>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="mb-4 has-validation">
                                        <?= $this->Form->control('price', [
                                            'class' => 'form-control mx-auto',
                                            'label' => ['text' => '<h4><span style="color: red;">*</span>Price</h4>', 'escape' => false],
                                            'type' => 'number',
                                            'min' => '0',
                                            'max' => PRODUCT_MAX_PRICE,
                                            'placeholder' => 'Please set your product price...',
                                            'required' => true,
                                        ]) ?>
                                        <div class="invalid-feedback">Product price ranges from 0 to <?= PRODUCT_MAX_PRICE ?></div>
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
                                            'label' => ['text' => '<h4><span style="color: red;">*</span>Quantity</h4>', 'escape' => false],
                                            'type' => 'number',
                                            'min' => '0',
                                            'max' => PRODUCT_MAX_QUANTITY,
                                            'placeholder' => 'Enter the quantity...',
                                            'required' => true,
                                        ]) ?>
                                        <div class="invalid-feedback">Product quantity ranges from 0 to <?= PRODUCT_MAX_QUANTITY ?></div>
                                    </div>

                                    <div class="mb-4 has-validation">
                                        <?= $this->Form->control('categories._ids', [
                                            'type' => 'select',
                                            'label' => ['text' => '<h4><span style="color: red;">*</span>Categories</h4>', 'escape' => false],
                                            'options' => $categoriesList,
                                            'multiple' => true,
                                            'class' => 'form-select select2',
                                            'empty' => false,
                                            'value' => $this->request->getQuery('categories._ids'),
                                            'required' => true,
                                        ]) ?>
                                        <div class="invalid-feedback">Product should have at least a category</div>
                                    </div>
                                </div>
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
                placeholder: "Select categories",
                allowClear: true,
            });
        });
    </script>

    <!-- Custom JS -->
    <?= $this->Html->script('form-utils') ?>
    <?= $this->Html->script('form-validation') ?>
</body>