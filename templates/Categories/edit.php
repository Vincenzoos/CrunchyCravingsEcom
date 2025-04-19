<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 * @var string[]|\Cake\Collection\CollectionInterface $products
 */
?>

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
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
                <h1 class="display-4">Edit Category</h1>
                <p class="lead">Modify the details of the selected category below.</p>
            </div>
        </section>

        <!-- Edit Form Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="form-content" class="bg-light p-4 rounded">
                            <?= $this->Form->create($category, ['class' => 'form']) ?>

                            <div class="mb-4">
                                <?= $this->Form->control('name', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4>Category Name</h4>', 'escape' => false],
                                    'placeholder' => 'Enter the category name...',
                                    'required' => true,
                                ]) ?>
                            </div>
                            <div class="mb-4">
                                <?= $this->Form->control('description', [
                                    'class' => 'form-control mx-auto',
                                    'label' => ['text' => '<h4 class="text-center" id="description-label">Description (0/150)</h4>', 'escape' => false],
                                    'placeholder' => 'Enter a brief description...',
                                    'type' => 'tel',
                                    'rows' => 4,
                                    'onkeyup' => 'limitInputLength(this, "description-label", "Description", 150)',
                                    'oninput' => 'removeScriptTags(this)',
                                    'maxlength' => 150, // Override maxlength
                                    'required' => true,
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 Initialization -->
    <script>
        jQuery(document).ready(function() {
            jQuery('.select2').select2({
                placeholder: "Select products",
                allowClear: true,
            });
        });
    </script>

    <!-- Custom JS -->
    <?= $this->Html->script('form-utils') ?>
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
            limitInputLength(descriptionInput, 'description-label', 'Description', 150);
        });
    </script>
</body>
