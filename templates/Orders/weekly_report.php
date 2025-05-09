<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'table', 'form']) ?>
</head>
<body>


<div class="page-container mx-auto p-5">

    <!-- Heading Section -->
    <section id="heading" class="text-center py-5">
        <div class="container">
            <h1 class="display-6 text-center">Weekly Sales Report</h1>
            <p class="lead text-center">View sales and product performance for the selected week.</p>
        </div>
    </section>

    <!-- Date Picker Form -->
    <div class="row align-items-center mb-3">
        <div class="col">
            <h4 class="mb-0">Select a Week</h4>
        </div>
        <div class="col-auto">
            <?= $this->Form->create(null, ['type' => 'get', 'class' => 'd-flex align-items-center']) ?>
            <?= $this->Form->control('week', [
                'type' => 'week',
                'value' => $selectedWeek,
                'label' => false,
                'class' => 'form-control me-2',
            ]) ?>
            <button type="submit" class="btn btn-primary">View Report</button>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <!-- Weekly Sales Section -->
    <section id="weekly-sales" class="mb-5">
        <h2 class="mb-3">Sales (<?= h((new DateTime($weekStart))->format('D d/m/Y')) ?> - <?= h((new DateTime($weekEnd))->format('D d/m/Y')) ?>)</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>Revenue</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($weeklySales as $sale): ?>
                    <tr>
                        <td><?= h((new DateTime($sale->date))->format('D d/m/y')) ?></td>
                        <td><?= $this->Number->currency($sale->revenue, 'AUD') ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Product Performance Section -->
    <section id="product-performance">
        <h2 class="mb-3">Product Performance</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>Product</th>
                    <th>Total Sales</th>
                    <th>Popularity</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($weeklyProducts as $product): ?>
                    <tr>
                        <td><?= h($product->product_name) ?></td>
                        <td><?= h($product->total_sales) ?></td>
                        <td>
                            <?= $product->total_sales > 50 ? 'High' : ($product->total_sales > 20 ? 'Medium' : 'Low') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

</body>
