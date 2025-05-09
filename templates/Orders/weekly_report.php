<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- Custom CSS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <div class="d-flex flex-end justify-content-end mb-4">
            <div class="">
                <?= $this->Form->create(null, ['type' => 'get', 'class' => 'd-flex align-items-center']) ?>
                <?= $this->Form->control('week', [
                    'type' => 'week',
                    'placeholder' => 'Select a week you would like to see report...',
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

            <!-- Grand Total -->
            <div class="text-end pe-1">
                <h4 class="d-inline">Grand Total: </h4>
                <span class="total-amount"><?= $this->Number->currency($weeklyRevenue, 'AUD') ?></span>
            </div>

            <!-- Bar Chart -->
            <canvas id="salesChart" width="400" height="200"></canvas>


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
                            <td data-title="Product" class="product-thumbnail text-center">
                                <a style="color: #6E6E6E; display: block;" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'view', $product->id]) ?>">
                                    <?= $this->Html->image($product->image_cache_busted_url, [
                                        'alt' => $product->name,
                                        'class' => 'img-fluid rounded',
                                        'style' => 'height: 70px; object-fit: cover; width: 70px; display: block; margin: 0 auto;'
                                    ]) ?>
                                    <h5 style="font-size: 0.9rem; margin-top: 0.5rem;"><?= h($product->name) ?></h5>
                                </a>
                            </td>
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
        <div class="text-center mt-4">
            <?= $this->Html->link('Download', ['action' => ''], ['class' => 'btn btn-info']) ?>
            <?= $this->Html->link('Back to Orders', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    // Dates
                    labels: <?= json_encode($chartData['labels']) ?>,
                    datasets: [{
                        label: 'Revenue (AUD)',
                        // Revenues
                        data: <?= json_encode($chartData['revenues']) ?>,
                        backgroundColor: 'rgb(201, 168, 117, 0.7)',
                        borderColor: '#000000',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
