<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CartItem> $cartItems
 */
?>
<div class="cartItems index content">
<!--    --><?php //= $this->Html->link(__('New Cart Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Cart Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('quantity', 'Qty') ?></th>
                    <th><?= $this->Paginator->sort('price', 'Unit Price') ?></th>
                    <th><?= $this->Paginator->sort('sub_total', 'Sub Total') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $cartItem): ?>
                <tr>
                    <td><?= $cartItem->hasValue('product') ? $this->Html->link($cartItem->product->name, ['controller' => 'Products', 'action' => 'customerView', $cartItem->product->id]) : '' ?></td>
                    <td><?= $this->Number->format($cartItem->quantity) ?></td>
                    <td><?= $this->Number->currency($cartItem->product->price, 'AUD') ?></td>
                    <td><?= $this->Number->currency($cartItem->line_price, 'AUD') ?></td>
                    <td class="text-center">
                        <?= $this->Form->postLink(
                            __('Remove'),
                            ['action' => 'delete', $cartItem->id],
                            [
                                'class' => 'btn btn-danger btn-sm',
                                'confirm' => __('Are you sure you want to remove this item from cart: "{0}"?', $cartItem->product->name),
                            ],
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <h3>Total: <?= $this->Number->currency($total, 'AUD') ?></h3>
</div>
