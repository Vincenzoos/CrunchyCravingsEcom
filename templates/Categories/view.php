<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>


<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - Category Details</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'table', 'form']) ?>

    <?= $html->script('/libraries/jquery.min.js') ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6">View Category</h1>
                <p class="lead">Details of the selected category are shown below.</p>
            </div>
        </section>

        <!-- Category Details Section -->
        <section id="form-section" class="">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <!-- Left column -->
                    <div id="form-content" class="col-md-6" style="height: 100%;">
                        <h3 class="text-center">Name</h3>
                        <table class="table table-bordered">
                            <tr>
                                <td><?= h($category->name) ?></td>
                            </tr>
                        </table>
                        <div id="description-content" class="text-center mt-4">
                            <h3><?= __('Description') ?></h3>
                            <table class="table table-bordered">
                                <tr>
                                    <td><?= $this->Text->autoParagraph(h($category->description)); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Right column -->
                    <div id="form-content" class="col-md-6" style="height: 100%;">
                        <!-- Related Products Section -->
                        <?php if (!empty($category->products)) : ?>
                            <h3 class="text-center">Related Products</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th><?= __('Name') ?></th>
                                            <th><?= __('Price') ?></th>
                                            <th><?= __('Image') ?></th>
                                            <th class="text-center"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($category->products as $product) : ?>
                                            <tr>
                                                <td><?= h($product->name) ?></td>
                                                <td><?= $this->Number->currency($product->price, 'AUD', ['places' => 2]) ?></td>
                                                <td><?= $this->Html->image($product->image_cache_busted_url, [
                                                        'alt' => $product->name,
                                                        'class' => 'img-fluid rounded',
                                                        'style' => 'height: 100%; object-fit: cover; width: 100%;',
                                                    ]) ?></td>
                                                <td class="text-center">
                                                    <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $product->id], ['class' => 'btn btn-info btn-sm']) ?>
                                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $product->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                                    <?= $this->Form->postLink(
                                                        __('Delete'),
                                                        ['controller' => 'Products', 'action' => 'delete', $product->id],
                                                        [
                                                            'class' => 'btn btn-danger btn-sm',
                                                            'confirm' => __('Are you sure you want to delete this product: {0}?', $product->name),
                                                        ]
                                                    ) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </section>

        <!-- Actions -->
        <div class="text-center mt-4">
            <?= $this->Html->link('Edit Category', ['action' => 'edit', $category->id], ['class' => 'btn btn-warning']) ?>
            <?= $this->Form->postLink(
                'Delete Category',
                ['action' => 'delete', $category->id],
                [
                    'class' => 'btn btn-danger',
                    'confirm' => __('Are you sure you want to delete this category: {0}?', $category->name),
                ]
            ) ?>
        </div>
        <div class="text-center mt-4">
            <?= $this->Html->link('Back to Categories List', ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <!-- Bootstrap JS -->

</body>
