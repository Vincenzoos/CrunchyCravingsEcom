<?php
/**
 * Checkout Order Text email template
 *
 * @var \App\View\AppView $this
 * @var string $first_name Recipient's first name
 * @var string $last_name Recipient's last name
 * @var string $email Recipient's email address
 * @var array $cartItems Array of cart items (each item is expected to have a product, quantity, and line_price)
 * @var float $total Total order amount
 */

use Cake\Log\Log;

?>
<!--Thank you for your order, --><?php //= h($first_name) ?><!--!-->
Thank you for your order, <?= h($email) ?>!
--------------------------------------------------

<!--Hello --><?php //= h($first_name) ?><!-- --><?php //= h($last_name) ?><!--,-->
Hello <?= h($email) ?>,

Thank you for shopping with CrunchyCravings.
Below is a summary of your order:

<?php foreach ($cartItems as $item): ?>
<!--    --><?php
//        Log::write('debug', json_encode([
//            'product_name' => $item->product->name,
//            'price' => $item->product->price,
//            'line_price' => $item->line_price,
//        ]));
//    ?>
    Product: <?= h($item->product->name ?? 'Unknown Product') ?>
    Quantity: <?= h($item->quantity ?? 0) ?>
    Unit Price: <?= $this->Number->currency($item->product->price ?? 0, 'AUD') ?>
    Sub Total: <?= $this->Number->currency($item->line_price ?? 0, 'AUD') ?>
    --------------------------------------------------
<?php endforeach; ?>

Total: <?= $this->Number->currency($total, 'AUD') ?>

We will process your order and update you once your items are on their way.
If you have any questions, please feel free to contact us.

Best regards,
CrunchyCravings

--------------------------------------------------
<!--This email is addressed to --><?php //= h($first_name) ?><!-- --><?php //= h($last_name) ?><!-- <--><?php //= h($email) ?><!-->.-->
This email is addressed to <?= h($email) ?>.
If you did not place this order, please contact our support team immediately.

Copyright © <?= date("Y") ?> CrunchyCravings
