<?php
/**
 * Checkout Order HTML email template
 *
 * @var \App\View\AppView $this
 * @var string $first_name Recipient's first name
 * @var string $last_name Recipient's last name
 * @var string $trackingNumber Order tracking number
 * @var string $email Recipient's email address
 * @var array $cartItems Array of cart items (each with product, quantity, line_price, etc.)
 * @var float $total Total order amount
 */
?>
<div class="content">
    <!-- START CENTERED WHITE CONTAINER -->
    <table role="presentation" class="main" style="width:100%; border-collapse: collapse;">
        <!-- START MAIN CONTENT AREA -->
        <tr>
            <td class="wrapper" style="padding: 20px;">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
                        <td>
                            <h3>Thank you for your order!</h3>
<!--                            <p>Hi --><?php //= h($first_name) ?><!--,</p>-->
                            <p>Hi <?= h($email) ?>,</p>
                            <p>
                                Thank you for shopping with <b>CrunchyCravings</b>.
                                <br><br>
                                Your tracking number is: <b><?= h($trackingNumber) ?></b>
                                <br>
                                You can use this tracking number to track your order's delivery status on our website or the courier's tracking page.
                                <br><br>
                                Below is a summary of your order:
                            </p>
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="width:100%; border: 1px solid #ddd;">
                                <thead>
                                <tr>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Product</th>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Quantity</th>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Unit Price</th>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Sub Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($cartItems as $item): ?>
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 8px;"><?= h($item->product->name) ?></td>
                                        <td style="border: 1px solid #ddd; padding: 8px;"><?= h($item->quantity) ?></td>
                                        <td style="border: 1px solid #ddd; padding: 8px;">
                                            <?= $this->Number->currency($item->product->price, 'AUD') ?>
                                        </td>
                                        <td style="border: 1px solid #ddd; padding: 8px;">
                                            <?= $this->Number->currency($item->line_price, 'AUD') ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <p>
                                <strong>Total: </strong>
                                <?= $this->Number->currency($total, 'AUD') ?>
                            </p>
                            <p>
                                We will process your order and update you once your items are on their way.
                                If you have any questions, please feel free to contact us.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- END MAIN CONTENT AREA -->
    </table>
    <!-- END CENTERED WHITE CONTAINER -->
    <!-- START FOOTER -->
    <div class="footer" style="margin-top: 10px; text-align: center; font-size: 12px; color: #999;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
            <tr>
                <td class="content-block" style="color:darkred; padding: 10px;">
<!--                    This email is addressed to --><?php //= h($first_name) ?><!-- --><?php //= h($last_name) ?><!-- &lt;--><?php //= h($email) ?><!--&gt;<br>-->
                    This email is addressed to <?= h($email) ?><br>
                    Please ignore this email if you did not place an order.<br><br>
                    Copyright &copy; <?= date("Y"); ?> CrunchyCravings
                </td>
            </tr>
        </table>
    </div>
    <!-- END FOOTER -->
</div>
