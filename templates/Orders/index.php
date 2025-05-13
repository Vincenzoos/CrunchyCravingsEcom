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
    <?= $this->Html->css(['utilities', 'table', 'form']) ?>
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
            <?= $this->Html->link(__('Weekly Sales Report'), ['action' => 'weeklyReport'], ['class' => 'btn btn-danger mx-1']) ?>
            <?= $this->Html->link(__('Monthly Sales Report'), ['action' => 'monthlyReport'], ['class' => 'btn btn-danger mx-1']) ?>
            <?= $this->Html->link(__('Yearly Sales Report'), ['action' => 'yearlyReport'], ['class' => 'btn btn-danger mx-1']) ?>
        </div>
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
                        <!-- TODO: Idea 1: Display only relevant action to for each order-->
<!--                            --><?php //= $this->Html->link(__('View'), ['action' => 'view', $order->id], ['class' => 'btn btn-info btn-sm']) ?>
<!--                            --><?php //if ($order->status == 'pending') : ?>
<!--                                --><?php //= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id], ['class' => 'btn btn-warning btn-sm']) ?>
<!--                                --><?php //= $this->Form->postLink(
//                                    __('Cancel'),
//                                    ['action' => 'cancel', $order->id],
//                                    [
//                                        'class' => 'btn btn-danger btn-sm',
//                                        'confirm' => __('Are you sure you want to cancel this order: #{0}?', $order->tracking_number),
//                                    ],
//                                ) ?>
<!--                            --><?php //elseif ($order->status == 'cancelled') : ?>
<!--                                --><?php //= $this->Form->postLink(
//                                    __('Delete'),
//                                    ['action' => 'delete', $order->id],
//                                    [
//                                        'class' => 'btn btn-danger btn-sm',
//                                        'confirm' => __('Are you sure you want to delete this order: #{0}?', $order->tracking_number),
//                                    ],
//                                ) ?>
<!--                            --><?php //endif; ?>

                            <!-- TODO: Idea 2: Only switch between cancel and delete based on order status-->
<!--                            --><?php //= $this->Html->link(__('View'), ['action' => 'view', $order->id], ['class' => 'btn btn-info btn-sm']) ?>
<!--                            --><?php //= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id], ['class' => 'btn btn-warning btn-sm']) ?>
<!--                            --><?php //if ($order->status === 'pending') : ?>
<!--                                --><?php //= $this->Form->postLink(
//                                    __('Cancel'),
//                                    ['action' => 'cancel', $order->id],
//                                    [
//                                        'class' => 'btn btn-danger btn-sm',
//                                        'confirm' => __('Are you sure you want to cancel this order: #{0}?', $order->tracking_number),
//                                    ],
//                                ) ?>
<!--                            --><?php //elseif ($order->status === 'cancelled') : ?>
<!--                                --><?php //= $this->Form->postLink(
//                                    __('Delete'),
//                                    ['action' => 'delete', $order->id],
//                                    [
//                                        'class' => 'btn btn-danger btn-sm',
//                                        'confirm' => __('Are you sure you want to delete this order: #{0}?', $order->tracking_number),
//                                    ],
//                                ) ?>
<!--                            --><?php //endif; ?>

                            <!-- TODO: Idea 3: Showing all actions, regardless of whether user can perform it or not-->
                            <?= $this->Html->link(__('View'), ['action' => 'view', $order->id], ['class' => 'btn btn-info btn-sm']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id], ['class' => 'btn btn-warning btn-sm']) ?>
                            <?= $this->Form->postLink(
                                __('Cancel'),
                                ['action' => 'cancel', $order->id],
                                [
                                    'class' => 'btn btn-secondary btn-sm',
                                    'confirm' => __('Are you sure you want to cancel this order: #{0}?', $order->tracking_number),
                                ],
                            ) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $order->id],
                                [
                                    'class' => 'btn btn-danger btn-sm',
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
</body>
