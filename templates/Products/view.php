<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
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
    <title>CrunchyCravings - Product Details</title>

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
                <h1 class="display-6">View Product</h1>
                <p class="lead">Details of the selected product are shown below.</p>
            </div>
        </section>

        <!-- Product Details Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div id="form-content" class="row justify-content-center text-center">
                    <!-- Left column -->
                    <div class="col-md-6">
                        <h3><?= h($product->name) ?></h3>
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('Name') ?></th>
                                <td><?= h($product->name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Price') ?></th>
                                <td><?= $this->Number->currency($product->price, 'AUD') ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Quantity') ?></th>
                                <td><?= h($product->quantity) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Associated Categories') ?></th>
                                <td>
                                    <?php if (!empty($associatedCategoryIds) && !empty($allCategories)) : ?>
                                        <?php $categoryNames = []; ?>
                                        <?php foreach ($associatedCategoryIds as $categoryId) : ?>
                                            <?php if (isset($allCategories[$categoryId])) : ?>
                                                <?php $categoryNames[] = h($allCategories[$categoryId]); ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?= !empty($categoryNames) ? implode(', ', $categoryNames) : __('No associated categories available.') ?>
                                    <?php else : ?>
                                        <?= __('No associated categories available.') ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>

                        <!-- Ingredients Section -->
                        <div id="ingredients-content" class="mt-4">
                            <h3><?= __('Ingredients') ?></h3>
                            <table class="table table-bordered">
                                <tr>
                                    <td style="word-break: break-word; overflow-wrap: break-word; white-space: normal; max-width: 100%;">
                                        <?= $this->Text->autoParagraph(h($product->ingredients)); ?>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Description Section -->
                        <div id="description-content" class="mt-4">
                            <h3><?= __('Description') ?></h3>
                            <table class="table table-bordered">
                                <tr>
                                    <td style="word-break: break-word; overflow-wrap: break-word; white-space: normal; max-width: 100%;">
                                        <?= $this->Text->autoParagraph(h($product->description)); ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Image section -->
                        <div id="image-content">
                            <h3><?= __('Product Image') ?></h3>
                            <div class="text-center">
                                <?= $this->Html->image($product->image_cache_busted_url, [
                                    'alt' => $product->name,
                                    'class' => 'img-fluid rounded',
                                    'style' => 'max-width: 78%; height: auto;',
                                ]) ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        
        <!-- Actions -->
        <div class="text-center mt-4">
            <?= $this->Html->link('Edit Product', ['action' => 'edit', $product->id], ['class' => 'btn btn-warning']) ?>
            <?= $this->Form->postLink(
                'Delete Product',
                ['action' => 'delete', $product->id],
                [
                    'class' => 'btn btn-danger',
                    'confirm' => __('Are you sure you want to delete this product: {0}?', $product->name),
                ],
            ) ?>
        </div>
        <div class="text-center mt-4">
            <?= $this->Html->link('Back to Products List', ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    
</body>