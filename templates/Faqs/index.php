<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Faq> $faqs
 */

use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - FAQs</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'table', 'form', 'filter']) ?>
</head>

<body>
    <!-- Page Container -->
    <div class="page-container mx-auto my-5">

        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6 text-center">FAQs</h1>
                <p class="lead text-center">Manage all FAQs below.</p>
            </div>
        </section>

        <!-- Shop container -->
        <div class="container" id="shop-container">
            <!-- Top Bar -->
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h4 class="mb-0">FAQs (<?= count($faqs) ?>)</h4>
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
                                <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'title_asc'])]) ?>">Title (A-Z)</a></li>
                                <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'title_desc'])]) ?>">Title (Z-A)</a></li>
                                <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'created_asc'])]) ?>">Created (Oldest First)</a></li>
                                <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'created_desc'])]) ?>">Created (Newest First)</a></li>
                                <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'clicks_asc'])]) ?>">Clicks (Lowest First)</a></li>
                                <li><a href="<?= $this->App->appUrl(['?' => array_merge($this->request->getQuery(), ['sort' => 'clicks_desc'])]) ?>">Clicks (Highest First)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="d-flex" id="filter-container">
                <div id="filter-sidebar" class="closed">
                    <h5>Filters</h5>
                    <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3']) ?>

                    <div class="mb-4">
                        <!-- Title Field -->
                        <div class="mb-3">
                            <?= $this->Form->control('title', [
                                'label' => 'Title',
                                'type' => 'text',
                                'placeholder' => 'Title contains...',
                                'value' => $this->request->getQuery('title'),
                                'class' => 'form-control',
                            ]) ?>
                        </div>

                        <!-- Answer Field -->
                        <div class="mb-3">
                            <?= $this->Form->control('answer', [
                                'label' => 'Answer',
                                'type' => 'text',
                                'placeholder' => 'Answer contains...',
                                'value' => $this->request->getQuery('answer'),
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
                <div id="filter-content">
                    <?= $this->Flash->render() ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover shadow mb-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th><?= $this->Paginator->sort('title', __('Title')) ?></th>
                                    <th><?= $this->Paginator->sort('clicks', __('Clicks')) ?></th>
                                    <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
                                    <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                                    <th class="text-center"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($faqs as $faq) : ?>
                                    <tr>
                                        <td><?= h($faq->title) ?></td>
                                        <td><?= h($faq->clicks) ?></td> <!-- Display clicks -->
                                        <td><?= h($faq->created->format('d/m/Y H:i a')) ?></td>
                                        <td><?= h($faq->modified->format('d/m/Y H:i a')) ?></td>
                                        <td class="text-center">
                                            <?= $this->Html->link(__('View'), ['action' => 'view', $faq->id], ['class' => 'btn btn-info btn-sm']) ?>
                                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $faq->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                            <?= $this->Form->postLink(
                                                __('Delete'),
                                                ['action' => 'delete', $faq->id],
                                                [
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'confirm' => __('Are you sure you want to delete "{0}"?', $faq->title),
                                                ]
                                            ) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-4">
                        <?= $this->Html->link('Add New FAQ', ['action' => 'add'], ['class' => 'btn btn-success']) ?>
                    </div>

                </div>
                <!-- Paginator -->
                <?php if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()): ?>
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <ul class="pagination">
                            <?= $this->Paginator->first(__('<< First'), ['url' => $this->request->getQuery()]) ?>
                            <?= $this->Paginator->prev(__('< Previous'), ['url' => $this->request->getQuery()]) ?>
                            <p class="text-muted mx-3 mb-0">
                                <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total')) ?>
                            </p>
                            <?= $this->Paginator->next(__('Next >'), ['url' => $this->request->getQuery()]) ?>
                            <?= $this->Paginator->last(__('Last >>'), ['url' => $this->request->getQuery()]) ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Select2 Initialization -->
    <script>
        jQuery(document).ready(function() {
            jQuery('.select2').select2({
                placeholder: "Select categories",
                allowClear: true
            });
        });
    </script>

    <?= $this->Html->script('filter_utils.js') ?>
    <script>
        // Initialize the sort dropdown
        initializeSortDropdown('sort-button', 'sort-options');

        // Initialize the filter fields
        const filterFields = ['title','answer'];

        // Initialize the filter sidebar
        initializeFilterSidebar('filters-button', 'filter-sidebar', 'form', filterFields);
    </script>
</body>