<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyCravings - Edit Order</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'form']) ?>
</head>

<body>
<!-- Page Container -->
<div class="page-container mx-auto my-5">
    <!-- Heading Section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-6">Edit Order</h1>
            <p class="lead">Update the order details below.</p>
        </div>
    </section>

    <!-- Edit Form Section -->
    <section id="form-section" class="py-5">
        <div class="container">
            <div id="form-content" class="row justify-content-center">
                <div class="col-md-6">
                    <?= $this->Form->create($order, ['class' => 'form needs-validation', 'novalidate' => true]) ?>

                    <!-- Tracking Number -->
                    <div class="mb-4">
                        <?= $this->Form->control('tracking_number', [
                            'class' => 'form-control mx-auto',
                            'label' => ['text' => '<h4>Tracking Number</h4>', 'escape' => false],
                            'placeholder' => 'Enter the tracking number...',
                            'disabled' => true,
                        ]) ?>
                    </div>

                    <!-- Tracking Number -->
                    <div class="mb-4">
                        <?= $this->Form->control('created', [
                            'class' => 'form-control mx-auto',
                            'label' => ['text' => '<h4>Creation Date</h4>', 'escape' => false],
                            'disabled' => true,
                        ]) ?>
                    </div>

                    <!--TODO: Add validation for address later in OrderTable, also declared maxlength as constant in bootstrap to avoid mismatch -->

                    <!-- Origin Address -->
                    <div class="mb-4 has-validation">
                        <?= $this->Form->control('origin_address', [
                            'class' => 'form-control mx-auto',
                            'label' => ['text' => '<h4><span style="color: red;">*</span>Origin Address</h4>', 'escape' => false],
                            'placeholder' => 'Enter the origin address...',
                            'maxlength' => ORDER_ADDRESS_MAX_LENGTH,
                            'required' => true,
                            'oninput' => 'removeScriptTags(this)',
                            'pattern' => '^[a-zA-Z0-9\s,.-]+$',
                        ]) ?>
                    </div>

                    <!-- Destination Address -->
                    <div class="mb-4 has-validation">
                        <?= $this->Form->control('destination_address', [
                            'class' => 'form-control mx-auto',
                            'label' => ['text' => '<h4><span style="color: red;">*</span>Destination Address</h4>', 'escape' => false],
                            'placeholder' => 'Enter the destination address...',
                            'maxlength' => ORDER_ADDRESS_MAX_LENGTH,
                            'required' => true,
                            'oninput' => 'removeScriptTags(this)',
                            'pattern' => '^[a-zA-Z0-9\s,.-]+$',
                        ]) ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Shipped Date -->
                    <div class="mb-4 has-validation">
                        <?= $this->Form->control('shipped_date', [
                            'class' => 'form-control mx-auto',
                            'type' => 'datetime-local',
                            'min' => (new DateTime())->format('Y-m-d\T00:00'),
                            'label' => ['text' => '<h4>Shipped Date</h4>', 'escape' => false],
                            'empty' => true,
                            'value' => $order->shipped_date ? $order->shipped_date->format('d M Y, H:i A') : date('Y-m-d'),
                        ]) ?>
                    </div>
                    <!-- Estimated Delivery Date -->
                    <div class="mb-4 has-validation">
                        <?= $this->Form->control('estimated_delivery_date', [
                            'class' => 'form-control mx-auto',
                            'type' => 'datetime-local',
                            'min' => (new DateTime())->format('Y-m-d\T00:00'),
                            'label' => ['text' => '<h4>Estimated Delivery Date</h4>', 'escape' => false],
                            'empty' => true,
                            'value' => $order->estimated_delivery_date ? $order->estimated_delivery_date->format('d M Y, H:i A') : date('Y-m-d'),
                        ]) ?>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-lg']) ?>
                    <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-link']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </section>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<?= $this->Html->script('form-utils') ?>
<?= $this->Html->script('form-validation') ?>
</body>
