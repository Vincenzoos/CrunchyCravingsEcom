<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - Products</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'table', 'form']) ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-4">Products Table</h1>
                <p class="lead">Manage all products below.</p>
            </div>
        </section>

        <!-- Products Filter Form -->
        <div class="mb-4 p-4 rounded shadow-sm bg-light">
            <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3']) ?>

            <!-- Product Name Field -->
            <div class="col-md-4">
                <?= $this->Form->control('product_name', [
                    'label' => 'Product Name',
                    'placeholder' => 'Product name contains...',
                    'value' => $this->request->getQuery('product_name'),
                    'class' => 'form-control',
                ]) ?>
            </div>

            <!-- Min Price Field -->
            <div class="col-md-4">
                <?= $this->Form->control('min_price', [
                    'label' => 'Min Price',
                    'placeholder' => 'Minimum price...',
                    'value' => $this->request->getQuery('min_price'),
                    'class' => 'form-control',
                ]) ?>
            </div>

            <!-- Max Price Field -->
            <div class="col-md-4">
                <?= $this->Form->control('max_price', [
                    'label' => 'Max Price',
                    'placeholder' => 'Maximum price...',
                    'value' => $this->request->getQuery('max_price'),
                    'class' => 'form-control',
                ]) ?>
            </div>

            <!-- Filter Button -->
            <div class="col-md-2 align-self-end">
                <?= $this->Form->button(__('Filter'), ['class' => 'btn btn-success']) ?>
                <?= $this->Html->link('Clear', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
            </div>

            <?= $this->Form->end() ?>
        </div>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <div class="container-fluid" id="table-content">
                    <?= $this->Flash->render() ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover shadow mb-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th><?= $this->Paginator->sort('id', __('ID')) ?></th>
                                    <th><?= $this->Paginator->sort('name', __('Name')) ?></th>
                                    <th><?= $this->Paginator->sort('price', __('Price')) ?></th>
                                    <th><?= $this->Paginator->sort('quantity', __('Quantity')) ?></th>
                                    <th class="text-center"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) : ?>
                                    <tr>
                                        <td><?= h($product->id) ?></td>
                                        <td><?= h($product->name) ?></td>
                                        <td><?= $this->Number->currency($product->price, 'USD') ?></td>
                                        <td><?= h($product->quantity) ?></td>
                                        <td class="text-center">
                                            <?= $this->Html->link(__('View'), ['action' => 'view', $product->id], ['class' => 'btn btn-info btn-sm']) ?>
                                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                            <?= $this->Form->postLink(
                                                __('Delete'),
                                                ['action' => 'delete', $product->id],
                                                [
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'confirm' => __('Are you sure you want to delete {0}?', $product->name),
                                                ]
                                            ) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-4">
                        <?= $this->Html->link('Add New Product', ['action' => 'add'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>

                <!-- Paginator -->
                <div class="d-flex justify-content-center align-items-center mt-4">
                    <ul class="pagination">
                        <?= $this->Paginator->first(__('<< First')) ?>
                        <?= $this->Paginator->prev(__('< Previous')) ?>
                        <p class="text-muted mx-3 mb-0">
                            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total')) ?>
                        </p>
                        <?= $this->Paginator->next(__('Next >')) ?>
                        <?= $this->Paginator->last(__('Last >>')) ?>
                    </ul>
                </div>
            </div>
        </div>
    <!-- </div> -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>