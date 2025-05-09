<!-- File: templates/Orders/sales_report.php -->
<div class="sales-report">
    <h1>Sales Report</h1>

    <h2>Weekly Sales</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Product</th>
            <th>Total Sales</th>
            <th>Popularity</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($weeklySales as $sale): ?>
            <tr>
                <td><?= h($sale->product_name) ?></td>
                <td><?= h($sale->total_sales) ?></td>
                <td>
                    <?= $sale->total_sales > 50 ? 'High' : ($sale->total_sales > 20 ? 'Medium' : 'Low') ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Monthly Sales</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Product</th>
            <th>Total Sales</th>
            <th>Popularity</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($monthlySales as $sale): ?>
            <tr>
                <td><?= h($sale->product_name) ?></td>
                <td><?= h($sale->total_sales) ?></td>
                <td>
                    <?= $sale->total_sales > 200 ? 'High' : ($sale->total_sales > 100 ? 'Medium' : 'Low') ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Yearly Sales</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Product</th>
            <th>Total Sales</th>
            <th>Popularity</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($yearlySales as $sale): ?>
            <tr>
                <td><?= h($sale->product_name) ?></td>
                <td><?= h($sale->total_sales) ?></td>
                <td>
                    <?= $sale->total_sales > 1000 ? 'High' : ($sale->total_sales > 500 ? 'Medium' : 'Low') ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
