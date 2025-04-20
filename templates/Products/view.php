<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
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
                <h1 class="display-4">View Product</h1>
                <p class="lead">Details of the selected product are shown below.</p>
            </div>
        </section>

        <!-- Product Details Section -->
        <section id="form-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="form-content" class="text-center">
                            <h3><?= h($product->name) ?></h3>
                            <table class="table table-bordered">
                                <tr>
                                    <th><?= __('Image') ?></th>
                                    <td><?= $this->Html->image($product->image_cache_busted_url, [
                                            'alt' => $product->name,
                                            'class' => 'img-fluid rounded-top',
                                            'style' => 'height: 50%; object-fit: cover; width: 100%;'
                                        ]) ?></td>
                                </tr>
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
                                <tr>
                                    <th><?= __('Associated Categories') ?></th>
                                    <td>
                                        <?php if (!empty($associatedCategoryIds) && !empty($allCategories)) : ?>
                                            <!-- Display categories with commas in between by looking up the associated category id and using implode -->
                                            <?php $categoryNames = []; ?>
                                            <?php foreach ($associatedCategoryIds as $categoryId): ?>
                                                <?php if (isset($allCategories[$categoryId])): ?>
                                                    <?php $categoryNames[] = h($allCategories[$categoryId]); ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <?= !empty($categoryNames) ? implode(', ', $categoryNames) : __('No associated categories available.') ?>
                                        <?php else: ?>
                                            <?= __('No associated categories available.') ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tr>

                            </table>
                            							<!-- Description Section -->
							<div id="description-content" class="text-center mt-4">
								<h3><?= __('Description') ?></h3>
								<table class="table table-bordered">
									<tr>
										<td><?= $this->Text->autoParagraph(h($product->description)); ?></td>
									</tr>
								</table>
							</div>
                        </div>

                        <!-- Actions -->
                        <div class="text-center mt-4">
                            <?= $this->Html->link('Edit Product', ['action' => 'edit', $product->id], ['class' => 'btn btn-warning']) ?>
                            <?= $this->Form->postLink(
                                'Delete Product',
                                ['action' => 'delete', $product->id],
                                [
                                    'class' => 'btn btn-danger',
                                    'confirm' => __('Are you sure you want to delete this product: {0}?', $product->name),
                                ]
                            ) ?>
                        </div>
						<div class="text-center mt-4">
							<?= $this->Html->link('Back to Products List', ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
						</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
