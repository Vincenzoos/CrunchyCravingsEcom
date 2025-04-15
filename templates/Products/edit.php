<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var \Cake\Collection\CollectionInterface|array<string> $categories
 */
?>

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
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
                        <?= $this->Form->create($product, ['class' => 'form', 'type' => 'file']) ?>

                        <div class="mb-4">
                            <?= $this->Form->control('name', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4>Product Name</h4>', 'escape' => false],
                                'placeholder' => 'Enter the product name...',
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="mb-4">
                            <?= $this->Form->control('description', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4>Description</h4>', 'escape' => false],
                                'placeholder' => 'Enter a brief description...',
                                'type' => 'textarea',
                                'rows' => 4,
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="mb-4">
                            <?= $this->Form->control('price', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4>Price</h4>', 'escape' => false],
                                'placeholder' => 'Enter the price...',
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="mb-4">
                            <?= $this->Form->control('image', [
                                'type' => 'file',
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4>Image URL</h4>', 'escape' => false],
                            ]) ?>
                        </div>
                        <div class="mb-4">
                            <?= $this->Form->control('quantity', [
                                'class' => 'form-control mx-auto',
                                'label' => ['text' => '<h4>Quantity</h4>', 'escape' => false],
                                'placeholder' => 'Enter the quantity...',
                                'required' => true,
                            ]) ?>
                        </div>
                         <div class="mb-4">
                             <?= $this->Form->control('categories._ids', [
                                 'type' => 'select',
                                 'label' => ['text' => '<h4>Categories</h4>', 'escape' => false],
                                 'options' => $categoriesList,
                                 'multiple' => true,
                                 'class' => 'form-select select2', // use select2
                                 'empty' => false, // Disable the empty option
                                 'value' => $this->request->getQuery('categories._ids'),
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
</body>
