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
    <?= $this->Html->css(['utilities', 'table', 'form', 'filter']) ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Heading Section -->
        <div class="container">
            <h1 class="display-6 text-center">Products</h1>
            <p class="lead text-center">Manage all products below.</p>
        </div>

        <!-- Shop container -->
        <div class="container" id="shop-container">
            <!-- Top Bar -->
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h4 class="mb-0">Products (<?= count($products) ?>)</h4>
                </div>
                <div class="col-auto d-flex align-items-center">
                    <!-- Show/Hide Filters Button -->
                    <button id="filters-button" class="btn btn-outline-primary">
                        Show Filters <i class="fa fa-sliders"></i>
                    </button>

                    <!-- Sort By Dropdown -->
                    <div id="sort-dropdown">
                        <button id="sort-button" class="btn btn-outline-secondary">
                            Sort By
                        </button>
                        <div id="sort-options" class="dropdown-menu">
                            <ul style="list-style-type: none; padding: 0; margin: 0;">
                                <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'name_asc'])]) ?>">Name (A-Z)</a></li>
                                <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'name_desc'])]) ?>">Name (Z-A)</a></li>
                                <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'price_asc'])]) ?>">Price (Low to High)</a></li>
                                <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'price_desc'])]) ?>">Price (High to Low)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="d-flex" id="shop-container">
                <div id="filter-sidebar" class="hidden">
                    <h5>Filters</h5>
                    <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3']) ?>

                    <div class="mb-4">
                        <!-- Product Name Field -->
                        <div class="mb-3">
                            <?= $this->Form->control('product_name', [
                                'label' => 'Product Name',
                                'placeholder' => 'Name contains...',
                                'value' => $this->request->getQuery('product_name'),
                                'class' => 'form-control',
                            ]) ?>
                        </div>

                        <!-- Categories Field -->
                        <div class="mb-3">
                            <label for="categories-ids" class="form-label">Categories</label>
                            <?= $this->Form->select('categories._ids', $categoriesList, [
                                'id' => 'categories-ids',
                                'multiple' => true,
                                'class' => 'form-select select2',
                                'value' => $this->request->getQuery('categories._ids'),
                            ]) ?>
                        </div>

                        <!-- Min Price Field -->
                        <div class="mb-3">
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
                        <div class="mb-3">
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
                        <div class="text-center">
                            <?= $this->Form->button(__('Filter'), ['class' => 'btn btn-success']) ?>
                            <?= $this->Html->link('Clear', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
                        </div>
                    </div>

                    <?= $this->Form->end() ?>
                </div>

                <!-- Main Content -->
                <div id="filter-content" class="flex-grow-1">
                    <?= $this->Flash->render() ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover shadow mb-4">
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
                                            'class' => 'img-fluid rounded',
                                            'style' => 'height: 100px; object-fit: cover; width: 100px;'
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
    </div>

    <!-- Sort Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sortButton = document.getElementById('sort-button');
            const sortOptions = document.getElementById('sort-options');

            // Toggle the visibility of the dropdown menu
            sortButton.addEventListener('click', function (event) {
                event.stopPropagation(); // Prevent the click from propagating to the document
                sortOptions.classList.toggle('show');
            });

            // Close the dropdown if clicked outside
            document.addEventListener('click', function (event) {
                if (!sortButton.contains(event.target) && !sortOptions.contains(event.target)) {
                    sortOptions.classList.remove('show');
                }
            });
        });
    </script>

    <!-- Filter sidebar toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleFiltersButton = document.getElementById('filters-button');
            const filterSidebar = document.getElementById('filter-sidebar');

            // Check if there are any query parameters in the URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.toString()) {
                // Open the sidebar if there are filters in the URL
                filterSidebar.classList.add('open');
                filterSidebar.classList.remove('hidden');
                toggleFiltersButton.innerHTML = 'Hide Filters <i class="fa fa-sliders"></i>';
            }

            // Toggle the sidebar when the button is clicked
            toggleFiltersButton.addEventListener('click', function () {
                if (!filterSidebar.classList.contains('open')) {
                    // Show the sidebar
                    filterSidebar.classList.add('open');
                    filterSidebar.classList.remove('hidden');
                    toggleFiltersButton.innerHTML = 'Hide Filters <i class="fa fa-sliders"></i>';
                } else {
                    // Hide the sidebar
                    filterSidebar.classList.remove('open');
                    filterSidebar.classList.add('hidden');
                    toggleFiltersButton.innerHTML = 'Show Filters <i class="fa fa-sliders"></i>';
                }
            });
        });
    </script>
</body>