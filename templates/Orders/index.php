<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Order> $orders
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

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'table', 'form', 'filter']) ?>
</head>

<body>
<!-- Page Container -->
<div class="page-container mx-auto p-5">

    <!-- Heading Section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-6 text-center">Orders</h1>
            <p class="lead text-center">Manage all orders below.</p>
        </div>
    </section>

    <!-- Shop container -->
    <div class="container" id="shop-container">
        <!-- Top Bar -->
        <div class="row align-items-center mb-3">
            <div class="col">
                <h4 class="mb-0">Orders (<?= count($orders) ?>)</h4>
            </div>
            <div class="col-auto d-flex align-items-center">
                <?= $this->Html->link(__('Weekly Sales Report'), ['action' => 'weeklyReport'], ['class' => 'btn btn-danger mx-1']) ?>
                <?= $this->Html->link(__('Monthly Sales Report'), ['action' => 'monthlyReport'], ['class' => 'btn btn-danger mx-1']) ?>
                <?= $this->Html->link(__('Yearly Sales Report'), ['action' => 'yearlyReport'], ['class' => 'btn btn-danger mx-1']) ?>
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
                            <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'tracking_number', 'direction' => 'asc'])]) ?>">Tracking # (A-Z)</a></li>
                            <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'tracking_number', 'direction' => 'desc'])]) ?>">Tracking # (Z-A)</a></li>
                            <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'created', 'direction' => 'asc'])]) ?>">Date (Oldest First)</a></li>
                            <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'created', 'direction' => 'desc'])]) ?>">Date (Newest First)</a></li>
                            <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'total_price', 'direction' => 'asc'])]) ?>">Total (Low to High)</a></li>
                            <li><a href="<?= $this->Url->build(['?' => array_merge($this->request->getQuery(), ['sort' => 'total_price', 'direction' => 'desc'])]) ?>">Total (High to Low)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="d-flex" id="filter-container">
            <div id="filter-sidebar" class="closed" style="min-width: 300px;">
                <h5>Filters</h5>
                <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3']) ?>

                <div class="mb-4">
                    <!-- Tracking Number Field -->
                    <div class="mb-3">
                        <?= $this->Form->control('tracking_number', [
                            'label' => 'Tracking Number',
                            'placeholder' => 'Search tracking number...',
                            'value' => $this->request->getQuery('tracking_number'),
                            'class' => 'form-control',
                        ]) ?>
                    </div>

                    <!-- Email Contains Field -->
                    <div class="mb-3">
                        <?= $this->Form->control('user_email', [
                            'label' => 'Customer Email',
                            'placeholder' => 'Search by email...',
                            'value' => $this->request->getQuery('user_email'),
                            'class' => 'form-control',
                        ]) ?>
                    </div>

                    <!-- Status Field -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Order Status</label>
                        <?= $this->Form->select(
                            'status',
                            [
                                '' => 'All Statuses',
                                'pending' => 'Pending',
                                'shipped' => 'Shipped',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled'
                            ],
                            [
                                'class' => 'form-select select2',
                                'value' => $this->request->getQuery('status'),
                                'id' => 'status'
                            ]
                        ) ?>
                    </div>

                    <!-- Returned Status Field -->
                    <div class="mb-3">
                        <label for="is_returned" class="form-label">Return Status</label>
                        <?= $this->Form->select(
                            'is_returned',
                            [
                                '' => 'All Orders',
                                '1' => 'Returned',
                                '0' => 'Not Returned'
                            ],
                            [
                                'class' => 'form-select select2',
                                'value' => $this->request->getQuery('is_returned'),
                                'id' => 'is_returned'
                            ]
                        ) ?>
                    </div>

                    <!-- Date Range Fields -->
                    <div class="mb-3">
                        <?= $this->Form->control('date_from', [
                            'label' => 'From Date',
                            'type' => 'date',
                            'value' => $this->request->getQuery('date_from'),
                            'class' => 'form-control',
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('date_to', [
                            'label' => 'To Date',
                            'type' => 'date',
                            'value' => $this->request->getQuery('date_to'),
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
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th><?= $this->Paginator->sort('tracking_number', __('Tracking Number')) ?></th>
                            <th><?= $this->Paginator->sort('user_email', __('Customer Email')) ?></th>
                            <th><?= $this->Paginator->sort('status', __('Status')) ?></th>
                            <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
                            <th><?= $this->Paginator->sort('Total', __('Total Amount')) ?></th>
                            <th><?= $this->Paginator->sort('is_returned', __('Returned')) ?></th>
                            <th class="text-center"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td><?= h($order->tracking_number)?></td>
                                <td><?= h($order->user_email) ?></td>
                                <td><?= h($order->status) ?></td>
                                <td><?= h($order->created ? $order->created->format('d/m/Y H:m A') : 'N/A') ?></td>
                                <td> <?= $this->Number->currency(h($order->total_price), 'AUD') ?></td>
                                <!-- Show if the order is returned -->
                                <td class="text-center">
                                    <?php if ($order->is_returned) : ?>
                                        <i class="fa fa-times text-success"></i>
                                    <?php else : ?>
                                        <i class="fa fa-times text-danger"></i>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    // Determine if each button should be enabled, adjust its visibility accordingly
                                    $editEnabled = $order->status === 'pending';
                                    $cancelEnabled = $order->status === 'pending';
                                    $deleteEnabled = $order->status === 'cancelled';
                                    ?>

                                    <?= $this->Html->link(__('View'), ['action' => 'view', $order->id], ['class' => 'btn btn-info btn-sm']) ?>
                                    <?= $this->Html->link(
                                        __('Edit'),
                                        ['action' => 'edit', $order->id],
                                        ['class' => 'btn btn-warning btn-sm' . ($editEnabled ? '' : ' disabled')],
                                    ) ?>
                                    <?= $this->Form->postLink(
                                        __('Cancel'),
                                        ['action' => 'cancel', $order->id],
                                        [
                                            'class' => 'btn btn-secondary btn-sm' . ($cancelEnabled ? '' : ' disabled'),
                                            'confirm' => __('Are you sure you want to cancel this order: #{0}?', $order->tracking_number),
                                        ],
                                    ) ?>
                                    <?= $this->Form->postLink(
                                        __('Delete'),
                                        ['action' => 'delete', $order->id],
                                        [
                                            'class' => 'btn btn-danger btn-sm' . ($deleteEnabled ? '' : ' disabled'),
                                            'confirm' => __('Are you sure you want to delete this order: #{0}?', $order->tracking_number),
                                        ],
                                    ) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginator -->
                <?php if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()) : ?>
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
        const filterFields = ['tracking_number', 'user_email', 'status', 'is_returned', 'date_from', 'date_to'];

        // Initialize the filter sidebar
        initializeFilterSidebar('filters-button', 'filter-sidebar', 'form', filterFields);
    </script>
</body>
