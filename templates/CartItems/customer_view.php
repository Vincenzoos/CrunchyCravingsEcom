<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CartItem> $cartItems
 */
?>
<div class="cartItems index content">
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
                <?php foreach ($cartItems as $cartItem) : ?>
                <tr>
                    <td><?= $cartItem->hasValue('product') ? $this->Html->link($cartItem->product->name, ['controller' => 'Products', 'action' => 'customerView', $cartItem->product->id]) : '' ?></td>
                    <?= $this->Form->create(null, ['url' => ['action' => 'update', $cartItem->id]]) ?>
                    <td><?= $this->Form->input('quantity', [
                         'type' => 'number',
                         'min' => 1,
                         'label' => false,
                         'value' => $cartItem->quantity,
                         'class' => 'form-control input-sm',
                        ]) ?></td>
                    <td><?= $this->Number->currency($cartItem->product->price, 'AUD') ?></td>
                    <td><?= $this->Number->currency($cartItem->line_price, 'AUD') ?></td>
                    <td class="text-center">
                        <?= $this->Form->button(__('Update'), ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->end() ?>
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
    <h3>Total: <?= $this->Number->currency($total_price, 'AUD') ?></h3>
    <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerIndex']) ?>" class="btn btn-secondary">Continue Shopping</a>
    <a href="<?= $this->Url->build(['controller' => 'CartItems', 'action' => 'checkout']) ?>" class="btn btn-primary">Checkout</a>
</div>
