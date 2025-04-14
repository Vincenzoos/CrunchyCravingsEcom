<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - Product Details</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'table', 'form']) ?>
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
        <section id="details-section" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="details-content" class="text-center">
                            <h3><?= h($product->name) ?></h3>
                            <table class="table table-bordered">
                                <tr>
                                    <th><?= __('Name') ?></th>
                                    <td><?= h($product->name) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Price') ?></th>
                                    <td><?= $this->Number->currency($product->price, 'USD') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Quantity') ?></th>
                                    <td><?= h($product->quantity) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('ID') ?></th>
                                    <td><?= h($product->id) ?></td>
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

                        <!-- Related Categories Section -->
                        <?php if (!empty($product->categories)) : ?>
                            <div class="mt-5">
                                <h4>Related Categories</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th><?= __('ID') ?></th>
                                                <th><?= __('Name') ?></th>
                                                <th><?= __('Description') ?></th>
                                                <th class="text-center"><?= __('Actions') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($product->categories as $category) : ?>
                                                <tr>
                                                    <td><?= h($category->id) ?></td>
                                                    <td><?= h($category->name) ?></td>
                                                    <td><?= h($category->description) ?></td>
                                                    <td class="text-center">
                                                        <?= $this->Html->link(__('View'), ['controller' => 'Categories', 'action' => 'view', $category->id], ['class' => 'btn btn-info btn-sm']) ?>
                                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Categories', 'action' => 'edit', $category->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                                        <?= $this->Form->postLink(
                                                            __('Delete'),
                                                            ['controller' => 'Categories', 'action' => 'delete', $category->id],
                                                            [
                                                                'class' => 'btn btn-danger btn-sm',
                                                                'confirm' => __('Are you sure you want to delete {0}?', $category->name),
                                                            ]
                                                        ) ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Actions -->
                        <div class="text-center mt-4">
                            <?= $this->Html->link('Edit Product', ['action' => 'edit', $product->id], ['class' => 'btn btn-warning']) ?>
                            <?= $this->Form->postLink(
                                'Delete Product',
                                ['action' => 'delete', $product->id],
                                [
                                    'class' => 'btn btn-danger',
                                    'confirm' => __('Are you sure you want to delete {0}?', $product->name),
                                ]
                            ) ?>
                        </div>
						<div class="text-center mt-4">
							<?= $this->Html->link('Back to Products', ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
						</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>