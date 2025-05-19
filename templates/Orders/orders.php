<?php
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;
$html = new HtmlHelper(new View());

// Check if user is authenticated
$isAuthenticated = $this->request->getAttribute('identity') !== null;
?>

<head>
    <title>Order Tracking</title>
    <?= $this->Html->css(['utilities', 'shop', 'orders']) ?>
</head>

<body>
    <!-- Page Breadcrumb -->
    <div class="container">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a title="Home" href="<?= $this->App->appUrl(['controller' => 'Pages', 'action' => 'display', 'landing_page']) ?>">Home</a></li>
                <li><a title="Orders" href="<?= $this->App->appUrl(['controller' => 'Orders', 'action' => 'orders']) ?>">Order Lookup</a></li>
            </ol>
        </div>
    </div>

    <div id="shop-container" class="container">
        <h1 class="text-center" style="padding: 1rem 0;">Orders</h1>
        
        <?php if ($isAuthenticated): ?>
            <!-- Tab Navigation for Authenticated Users -->
            <ul class="nav nav-tabs mb-4" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="my-orders-tab" data-bs-toggle="tab" data-bs-target="#my-orders" type="button" role="tab" aria-controls="my-orders" aria-selected="true">My Orders</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="find-order-tab" data-bs-toggle="tab" data-bs-target="#find-order" type="button" role="tab" aria-controls="find-order" aria-selected="false">Find an Order</button>
                </li>
            </ul>
            
            <div class="tab-content" id="orderTabsContent">
                <!-- My Orders Tab -->
                <div class="tab-pane fade show active" id="my-orders" role="tabpanel" aria-labelledby="my-orders-tab">
                    <?php if (!empty($userOrders)): ?>
                        <?php foreach ($userOrders as $order): ?>
                            <?= $this->element('order_display', ['order' => $order, 'viewMode' => 'customer']); ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info text-center">You have no orders yet.</div>
                    <?php endif; ?>
                </div>
                
                <!-- Find an Order Tab -->
                <div class="tab-pane fade" id="find-order" role="tabpanel" aria-labelledby="find-order-tab">
                    <?php echo $this->element('order_lookup_form'); ?>
                    
                    <?php if (isset($foundOrder)): ?>
                        <?= $this->element('order_display', ['order' => $foundOrder, 'viewMode' => 'customer']); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <!-- Guest View - Only Order Lookup Form -->
            <?php echo $this->element('order_lookup_form'); ?>

            <?php if (isset($foundOrder)): ?>
                <?= $this->element('order_display', ['order' => $foundOrder, 'viewMode' => 'customer']); ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Include Bootstrap JS for tabs -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>