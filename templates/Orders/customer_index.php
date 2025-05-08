<!-- filepath: c:\xampp\htdocs\team068-app_fit3047\templates\Orders\customer_index.php -->
<!doctype html>
<html lang="en">

<head>
    <title>Order Tracking</title>
    <?= $this->Html->css(['utilities', 'shop', 'orders']) ?>
</head>

<body>
    <!-- Page Breadcrumb -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Orders" href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'customerIndex']) ?>">Orders</a></li>
            </ol>
        </div>
    </div>

    <!-- Orders Container -->
    <div id="orders-container" class="container">
        <h1 class="text-center" style="padding: 1rem 0;">My Orders</h1>

        <?php if (!empty($orders)) : ?>
            <?php foreach ($orders as $order) : ?>
                <div class="order-box mb-4 p-3 border rounded">
                    <h4>Order #<?= h($order->id) ?> - <?= h($order->status) ?></h4>
                    <p><strong>Order Date:</strong> <?= h($order->created->format('d M Y, H:i A')) ?></p>
<!--                 TODO: Should remove total price attribute from Order table-->
                    <p><strong>Total Price:</strong> <?= $this->Number->currency($order->total_price, 'AUD') ?></p>

                    <!-- Order Items Table -->
                    <table class="shop_table cart">
                        <thead>
                            <tr>
                                <th class="product-name">Product</th>
                                <th class="product-description">Description</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_price = 0?>
                            <?php foreach ($order->order_items as $item) : ?>
                                <tr>
                                    <td data-title="Product" class="product-thumbnail text-center">
                                        <a style="color: #6E6E6E; display: block;" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'customerView', $item->product->id]) ?>">
                                            <?= $this->Html->image($item->product->image_cache_busted_url, [
                                                'alt' => $item->product->name,
                                                'class' => 'img-fluid rounded',
                                                'style' => 'height: 70px; object-fit: cover; width: 70px; display: block; margin: 0 auto;'
                                            ]) ?>
                                            <h5 style="font-size: 0.9rem; margin-top: 0.5rem;"><?= h($item->product->name) ?></h5>
                                        </a>
                                    </td>
                                    <td data-title="Description" class="product-description">
                                        <?= h($item->product->description) ?>
                                    </td>
                                    <td data-title="Price" class="product-price">
                                        <span class="price-amount"><?= $this->Number->currency($item->product->price, 'AUD') ?></span>
                                    </td>
                                    <td data-title="Quantity" class="product-quantity">
                                        <?= h($item->quantity) ?>
                                    </td>
                                    <td data-title="Subtotal" class="product-subtotal">
                                        <span class="amount"><?= $this->Number->currency($item->line_price, 'AUD') ?></span>
                                    </td>
                                </tr>
                                <?php $total_price += $item->line_price ?>
                            <?php endforeach; ?>
                                <tr class="order-total">
                                    <th>Grand Total</th>
                                    <td><strong><span class="total-amount"><?= $this->Number->currency($total_price, 'AUD') ?></span></strong></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center">You have no orders yet.</p>
        <?php endif; ?>
    </div>
</body>

</html>
