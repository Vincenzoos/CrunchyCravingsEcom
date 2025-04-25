<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
?>

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
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
                <h1 class="display-6">Products Table</h1>
                <p class="lead">Manage all products below.</p>
            </div>
        </section>

        <!-- Filter Toggle Button -->
        <div class="text-center mb-3">
            <button class="btn btn-outline-secondary" type="button" id="toggle-filters" data-bs-toggle="collapse" data-bs-target="#filter-form" aria-expanded="false" aria-controls="filter-form">
                Show Filters <i class="fa fa-sliders"></i>
            </button>
        </div>

        <!-- Products Filter Form -->
        <div id="filter-form" class="collapse">
            <div id="form-content" class="col-md-2 mx-auto mb-4 p-3">
            <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3']) ?>

                <!-- Product Name Field -->
                <div class="col-12">
                    <?= $this->Form->control('product_name', [
                        'label' => 'Product Name',
                        'placeholder' => 'Name contains...',
                        'value' => $this->request->getQuery('product_name'),
                        'class' => 'form-control',
                    ]) ?>
                </div>

                <!-- Categories Field -->
                <div class="col-12">
                    <label for="categories-ids" class="form-label">Categories</label>
                    <?= $this->Form->select('categories._ids', $categoriesList, [
                        'id' => 'categories-ids',
                        'multiple' => true,
                        'class' => 'form-select select2', // use select2
                        'value' => $this->request->getQuery('categories._ids'),
                    ]) ?>
                </div>

                <!-- Min Price Field -->
                <div class="col-12">
                    <?= $this->Form->control('min_price', [
                        'label' => 'Min Price',
                        'placeholder' => '0',
                        'type' => 'number',
                        'min' => '0',
                        'max' => '500',
                        'value' => $this->request->getQuery('min_price'),
                        'class' => 'form-control',
                    ]) ?>
                </div>

                <!-- Max Price Field -->
                <div class="col-12">
                    <?= $this->Form->control('max_price', [
                        'label' => 'Max Price',
                        'placeholder' => '500',
                        'type' => 'number',
                        'min' => '0',
                        'max' => '500',
                        'value' => $this->request->getQuery('max_price'),
                        'class' => 'form-control',
                    ]) ?>
                </div>

                <!-- Filter Button -->
                <div class="col-12 text-center">
                    <?= $this->Form->button(__('Filter'), ['class' => 'btn btn-success']) ?>
                    <?= $this->Html->link('Clear', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <div class="container-fluid" id="table-content">
                    <?= $this->Flash->render() ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover shadow mb-4" style="width: 40%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th><?= $this->Paginator->sort('name', __('Name')) ?></th>
                                    <th><?= $this->Paginator->sort('price', __('Price')) ?></th>
                                    <th><?= $this->Paginator->sort('quantity', __('Quantity')) ?></th>
                                    <th><?= $this->Paginator->sort('image', __('Image')) ?></th>
                                    <th class="text-center"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) : ?>
                                    <tr>
                                        <td><?= h($product->name) ?></td>
                                        <td><?= $this->Number->currency($product->price, 'AUD') ?></td>
                                        <td><?= h($product->quantity) ?></td>
                                        <td><?= $this->Html->image($product->image_cache_busted_url, [
                                            'alt' => $product->name,
                                            'class' => 'img-fluid rounded-top',
                                            'style' => 'height: 100px; object-fit: cover; width: 100%;'
                                            ]) ?></td>
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
                <?php if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()): ?>
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
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Filter form toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterForm = document.getElementById('filter-form');
            const toggleFiltersButton = document.getElementById('toggle-filters');

            // Check if there are any query parameters in the URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.toString()) {
                // Open the filter form if there are filters in the URL
                filterForm.classList.add('show');
                toggleFiltersButton.innerHTML = 'Hide Filters <i class="fa fa-sliders"></i>';
            }

            // Listen for Bootstrap collapse events
            filterForm.addEventListener('shown.bs.collapse', function () {
                console.log('Filters are now visible');
                toggleFiltersButton.innerHTML = 'Hide Filters <i class="fa fa-sliders"></i>';
            });

            filterForm.addEventListener('hidden.bs.collapse', function () {
                console.log('Filters are now hidden');
                toggleFiltersButton.innerHTML = 'Show Filters <i class="fa fa-sliders"></i>';
            });
        });
    </script>

    <!-- Select2 Initialization -->
    <script>
        jQuery(document).ready(function() {
            jQuery('.select2').select2({
                placeholder: "Select categories",
                allowClear: true,
                width: '100%',
            });
        });
    </script>
</body>
