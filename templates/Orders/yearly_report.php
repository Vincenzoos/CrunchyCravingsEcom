<!-- Set page title    -->
<?php
$this->assign('title', 'Yearly Report');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom CSS -->
    <?= $this->Html->css(['utilities', 'table', 'form']) ?>
</head>
<body>
    <div class="page-container mx-auto p-5">
        <!-- Heading Section -->
        <section id="heading" class="text-center py-5">
            <div class="container">
                <h1 class="display-6 text-center">Yearly Sales Report</h1>
                <p class="lead text-center">Report for the period: <?= h($yearStart) ?> to <?= h($yearEnd) ?></p>
            </div>
        </section>

        <!-- Year Picker Form -->
        <div class="d-flex flex-end justify-content-end mb-4">
            <div class="">
                <?= $this->Form->create(null, ['type' => 'get', 'class' => 'd-flex align-items-center ignore-for-pdf']) ?>
                <?= $this->Form->control('year', [
                    'type' => 'year',
                    'placeholder' => 'Select a year you would like to see report...',
                    'empty' => false,
                    'label' => false,
                    'value' => (new \DateTime($yearStart))->format('Y'),
                    'class' => 'form-control ignore-for-pdf',
                ]) ?>
                <button type="submit" class="btn btn-danger mx-1 ignore-for-pdf">View Report</button>
                <?= $this->Form->end() ?>
            </div>
        </div>

        <!-- yearly Sales Section -->
        <section id="yearly-sales" class="mb-5">
            <h2 class="mb-3">Sales</h2>

            <!-- Grand Total -->
            <div class="text-end pe-1">
                <h4 class="d-inline">Grand Total: </h4>
                <span class="total-amount"><?= $this->Number->currency($yearlyRevenue, 'AUD') ?></span>
            </div>

            <!-- Bar Chart -->
            <canvas id="salesChart" width="400" height="200"></canvas>
        </section>

        <!-- Product Performance Section -->
        <section id="product-performance">
            <h2 class="mb-3">Product Performance</h2>

            <!-- Popularity Legend -->
            <div class="mb-3 text-end">
                <ul class="list-inline small">
                    <li class="list-inline-item">
                        <span class="badge bg-success">High</span> — More than <?= HIGH_POPULARITY_YEARLY ?> sales
                    </li>
                    <li class="list-inline-item">
                        <span class="badge bg-warning">Medium</span> — More than <?= MEDIUM_POPULARITY_YEARLY ?> sales
                    </li>
                    <li class="list-inline-item">
                        <span class="badge bg-danger">Low</span> — <?= MEDIUM_POPULARITY_YEARLY ?> sales or fewer
                    </li>
                </ul>
            </div>

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
                    <?php foreach ($yearlyProducts as $product) : ?>
                        <tr>
                            <td data-title="Product" class="product-thumbnail text-center">
                                <a style="color: #6E6E6E; display: block;" href="<?= $this->App->appUrl(['controller' => 'Products', 'action' => 'view', $product->id]) ?>">
                                    <?= $this->Html->image($product->image_cache_busted_url, [
                                        'alt' => $product->name,
                                        'class' => 'img-fluid rounded',
                                        'style' => 'height: 70px; object-fit: cover; width: 70px; display: block; margin: 0 auto;',
                                    ]) ?>
                                    <h5 style="font-size: 0.9rem; margin-top: 0.5rem;"><?= h($product->name) ?></h5>
                                </a>
                            </td>
                            <td><?= h($product->total_sales) ?></td>
                            <td>
                                <?php
                                if ($product->total_sales > HIGH_POPULARITY_YEARLY) {
                                    echo '<span class="badge bg-success">High</span>';
                                } elseif ($product->total_sales > MEDIUM_POPULARITY_YEARLY) {
                                    echo '<span class="badge bg-warning text-dark">Medium</span>';
                                } else {
                                    echo '<span class="badge bg-danger">Low</span>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <div class="text-center mt-4">
            <?= $this->Form->button('Download', [
                'type' => 'button',
                'class' => 'btn btn-primary ignore-for-pdf',
                'id' => 'downloadPdf',
            ]) ?>
            <?= $this->Html->link('Back to Orders', ['action' => 'index'], ['class' => 'btn btn-link ignore-for-pdf']) ?>
        </div>
    </div>

    <!-- Custom JS    -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <?= $this->Html->script('report_utils') ?>

    <!-- Config report page    -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializeReportPage({
                downloadButtonId: 'downloadPdf',
                containerSelector: '.page-container',
                filename: 'CC_Yearly_Report_<?=$yearStart?>_to_<?=$yearEnd?>.pdf',
                chartConfig: {
                    canvasId: 'salesChart',
                    labels: <?= json_encode($chartData['labels']) ?>,
                    data: <?= json_encode($chartData['revenues']) ?>,
                    label: 'Revenue (AUD)',
                    backgroundColor: 'rgb(201, 168, 117, 0.7)',
                    borderColor: '#000000'
                }
            });
        });
    </script>
</body>
