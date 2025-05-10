<!-- filepath: c:\xampp\htdocs\team068-app_fit3047\templates\Orders\order_lookup.php -->
<!doctype html>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order|null $order
 */

use Cake\View\Helper\HtmlHelper;
use Cake\View\View;
$html = new HtmlHelper(new View());
?>

<head>
    <title>Order Lookup</title>
    <?= $this->Html->css(['utilities', 'shop', 'orders']) ?>
    <!-- Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet.js JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body>
<div id="shop-container" class="container">
    <h1 class="text-center" style="padding: 1rem 0;">Track Your Order</h1>
    <div id="shop-box" class="mb-4 p-3">
        <div class="order-lookup form mx-auto" style="max-width: 500px;">
            <?= $this->Form->create(null) ?>
            <fieldset>
                <?= $this->Form->control('tracking_number', [
                    'label' => ['text' => 'Tracking Number', 'class' => 'text-center h4'],
                    'required' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Enter your tracking number',
                ]) ?>
            </fieldset>
            <div class="text-center mt-3">
                <?= $this->Form->button(__('Lookup Order'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <div id="shop-box" class="mb-4 p-3">
        <?php if (isset($order)): ?>
            <h4 class="text-center" style="padding: 1rem 0;">Order #<?= h($order->id) ?> - <?= h($order->status) ?></h4>
            <p><strong>Order Date:</strong> <?= h($order->created->format('d M Y, H:i A')) ?></p>
            <p><strong>Origin Address:</strong> <?= h($order->origin_address) ?></p>
            <p><strong>Destination Address:</strong> <?= h($order->destination_address) ?></p>

            <!-- Shipping Tracking -->
            <?php if ($order->shipped_date && $order->estimated_delivery_date) : ?>
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

            <!-- Grand Total Section -->
            <div class="text-end pe-1 mt-4">
                <h4 class="d-inline">Grand Total: </h4>
                <span class="total-amount"><?= $this->Number->currency($order->total_price, 'AUD') ?></span>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="alert alert-danger text-center mt-4">
                <?= h($error) ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>