<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Order> $orders
 */
?>

<?php
use Cake\View\Helper\HtmlHelper;
$html = new HtmlHelper(new \Cake\View\View());
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

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

    <div class="row align-items-center mb-3">
        <div class="col">
            <h4 class="mb-0">Orders (<?= count($orders) ?>)</h4>
        </div>
        <div class="col-auto d-flex align-items-center">
            <?= $this->Html->link(__('Sales Report'), ['action' => 'salesReport'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <!-- Main Content -->
    <div id="filter-content">
        <?= $this->Flash->render() ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                <tr>
                    <th><?= $this->Paginator->sort('id', __('ID')) ?></th>
                    <th><?= $this->Paginator->sort('user_id', __('Customer')) ?></th>
                    <th><?= $this->Paginator->sort('status', __('Status')) ?></th>
                    <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
                    <th><?= $this->Paginator->sort('Total', __('Total Amount')) ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $this->Number->format($order->id) ?></td>
                        <td><?= $order->hasValue('user') ? $this->Html->link($order->user->email, ['controller' => 'Users', 'action' => 'view', $order->user->id]) : '' ?></td>
                        <td><?= h($order->status) ?></td>
                        <td><?= h($order->created ? $order->created->format('d/m/Y H:m A') : 'N/A') ?></td>
                        <td> <?= $this->Number->currency(h($order->total_price), 'AUD') ?></td>
                        <td class="text-center">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $order->id], ['class' => 'btn btn-info btn-sm']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id], ['class' => 'btn btn-warning btn-sm']) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $order->id],
                                [
                                    'class' => 'btn btn-danger btn-sm',
                                    'confirm' => __('Are you sure you want to delete this order: #{0}?', $order->id),
                                ]
                            ) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
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

<?= $this->Html->script('filter_utils.js') ?>
</body>
