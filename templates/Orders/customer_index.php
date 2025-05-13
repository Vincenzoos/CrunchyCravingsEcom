<!doctype html>
<!--
**********************************************************************************************************
    Copyright (c) 2024 Webstrot Technology
********************************************************************************************************** -->
<!--
Template Name: Luxury Shop Ecommerce HTML Template
Version: 1.0.0
Author: webstrot
Website: http://webstrot.com/
Purchase: http://themeforest.net/user/webstrot  -->

<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class=""> <!--<![endif]-->

<sc?php
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;
$html = new HtmlHelper(new View());
?>

<head>
    <title>Order Tracking</title>
    <?= $this->Html->css(['utilities', 'shop', 'orders']) ?>
    <!-- Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet.js JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body>
    <!-- Page Breadcrumb -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->App->appUrl(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Orders" href="<?= $this->App->appUrl(['controller' => 'Orders', 'action' => 'customerIndex']) ?>">Orders</a></li>
            </ol>
        </div>
    </div>

    <!-- shop Container -->
    <div id="shop-container" class="container">
        <h1 class="text-center" style="padding: 1rem 0;">My Orders</h1>

        <?php if (!empty($orders)) : ?>
            <?php foreach ($orders as $order) : ?>
                <div id="shop-box" class="mb-4 p-3">
                    <h4 class="text-center" style="padding: 1rem 0;"><?= h(ucfirst($order->status ?? 'Unknown')) ?> Order</h4>
                    <p><strong>Tracking Number:</strong> <?= h($order->tracking_number ?? 'N/A') ?></p>
                    <!-- Shipping Tracking -->
                    <?php if (!empty($order->shipped_date) && !empty($order->estimated_delivery_date)) : ?>
                        <?php
                        $now = new \DateTime();
                        $deliveryDate = $order->estimated_delivery_date;
                        $interval = $now->diff($deliveryDate);

                        if ($now > $deliveryDate) {
                            $shippingStatus = 'Delivered';
                        } elseif ($interval->days > 0) {
                            $shippingStatus = $interval->days . ' days remaining';
                        } else {
                            $shippingStatus = 'Less than a day remaining';
                        }
                        ?>
                        <p><strong>Shipping Status:</strong> <?= h($shippingStatus) ?></p>
                    <?php else : ?>
                        <p><strong>Shipping Status:</strong> Not shipped yet</p>
                    <?php endif; ?>
                    <hr style="border: 1px solid #ccc; margin: 20px 0;">
                    <p><strong>Order Date:</strong> <?= h($order->created ? $order->created->format('d M Y, H:i A') : 'N/A') ?></p>
                    <p><strong>Estimated Delivery Date:</strong> <?= h($order->estimated_delivery_date ? $order->estimated_delivery_date->format('d M Y') : 'N/A') ?></p>
                    <hr style="border: 1px solid #ccc; margin: 20px 0;">
                    <p><strong>Origin Address:</strong> <?= h($order->origin_address ?? 'N/A') ?></p>
                    <p><strong>Destination Address:</strong> <?= h($order->destination_address ?? 'N/A') ?></p>
                    <hr style="border: 1px solid #ccc; margin: 20px 0;">

                    <!-- Map Section -->
                    <div id="map-<?= h($order->id) ?>" style="width: 100%; height: 400px; margin-top: 20px;"></div>

                    <!-- Leaflet.js Map Script -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const map = L.map('map-<?= h($order->id) ?>');

                            // Add OpenStreetMap tiles
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '© OpenStreetMap contributors'
                            }).addTo(map);

                            // Add markers for origin and destination
                            const origin = "<?= h($order->origin_address) ?>";
                            const destination = "<?= h($order->destination_address) ?>";

                            let originLatLng, destinationLatLng;

                            // Use Leaflet's geocoding plugin or a third-party geocoding service to convert addresses to coordinates
                            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(origin)}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.length > 0) {
                                        originLatLng = [data[0].lat, data[0].lon];
                                        L.marker(originLatLng).addTo(map).bindPopup("Origin: <?= h($order->origin_address) ?>").openPopup();
                                        if (originLatLng && destinationLatLng) {
                                            map.fitBounds([originLatLng, destinationLatLng], { padding: [50, 50] });
                                        }
                                    }
                                });

                            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(destination)}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.length > 0) {
                                        destinationLatLng = [data[0].lat, data[0].lon];
                                        L.marker(destinationLatLng).addTo(map).bindPopup("Destination: <?= h($order->destination_address) ?>");
                                        if (originLatLng && destinationLatLng) {
                                            map.fitBounds([originLatLng, destinationLatLng], { padding: [50, 50] });
                                        }
                                    }
                                });
                        });
                    </script>

                    <!-- Order Items Table -->
                    <div class="shopping-cart-table">
                        <table class="shop_table">
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
                                <?php foreach ($order->order_items as $item) : ?>
                                    <tr>
                                        <td data-title="Product" class="product-thumbnail text-center">
                                            <a style="color: #6E6E6E; display: block;" href="<?= $this->App->appUrl(['controller' => 'Products', 'action' => 'customerView', $item->product->id]) ?>">
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
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Grand Total Section -->
                    <div class="grand-total-section d-flex justify-content-between align-items-center pe-1 py-3 border-top">
                        <div>
                            <?php if ($order->status === 'pending') : ?>
                                    <?= $this->Form->postLink(
                                        __('Cancel Order'),
                                        ['controller' => 'Orders', 'action' => 'cancel', $order->id],
                                        [
                                            'confirm' => __('Are you sure you want to cancel this order? #{0}', $order->tracking_number),
                                            'class' => 'btn btn-danger btn-sm px-4'
                                        ]
                                    ) ?>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h4 class="d-inline me-2">Grand Total:</h4>
                            <span class="total-amount fw-bold fs-5"><?= $this->Number->currency($order->total_price, 'AUD') ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center">You have no orders yet.</p>
        <?php endif; ?>
    </div>
</body>

</html>
