<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Collection\Collection;
use Cake\Event\EventInterface;
use DateTime;
use Exception;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Orders->find()
            ->contain(['OrderItems.Products']);

        // Apply filters
        if ($this->request->getQuery('tracking_number')) {
            $query->where(['Orders.tracking_number LIKE' => '%' . $this->request->getQuery('tracking_number') . '%']);
        }

        if ($this->request->getQuery('user_email')) {
            $query->where(['Orders.user_email LIKE' => '%' . $this->request->getQuery('user_email') . '%']);
        }

        if ($this->request->getQuery('status')) {
            $query->where(['Orders.status' => $this->request->getQuery('status')]);
        }

        if ($this->request->getQuery('is_returned') !== null && $this->request->getQuery('is_returned') !== '') {
            $returnStatus = $this->request->getQuery('is_returned') === '1' ? 'returned' : 'not_returned';
            $query->where(['Orders.return_status' => $returnStatus]);
        }

        if ($this->request->getQuery('date_from')) {
            $dateFrom = new DateTime($this->request->getQuery('date_from'));
            $query->where(['Orders.created >=' => $dateFrom->format('Y-m-d 00:00:00')]);
        }

        if ($this->request->getQuery('date_to')) {
            $dateTo = new DateTime($this->request->getQuery('date_to'));
            $query->where(['Orders.created <=' => $dateTo->format('Y-m-d 23:59:59')]);
        }

        // Apply sorting if requested
        $sortField = 'Orders.created';
        $sortDirection = 'DESC';

        if ($this->request->getQuery('sort') && $this->request->getQuery('direction')) {
            $sortField = 'Orders.' . $this->request->getQuery('sort');
            $sortDirection = strtoupper($this->request->getQuery('direction'));
        }

        // Set order in pagination settings only
        $this->paginate = [
            'order' => [$sortField => $sortDirection],
            'limit' => 10,
        ];

        // Pass query with `contain` directly to paginate()
        $orders = $this->paginate($query);

        $this->set(compact('orders'));
    }

    /**
     * Customer Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function customerIndex()
    {
        $userEmail = $this->request->getAttribute('identity')->email;

        if (empty($userEmail)) {
            $this->Flash->error(__('You must be logged in to view your orders.'));

            return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
        }

        $orders = $this->Orders->find('all', [
            'conditions' => ['Orders.user_email' => $userEmail],
            'contain' => ['OrderItems.Products'], // Include related order items and products
            'order' => ['Orders.created' => 'DESC'],
        ])->toArray();

        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        if (!ctype_digit($id)) {
            $this->Flash->error(__('Order not found.'));

            return $this->redirect(['action' => 'index']);
        }
        try {
            $order = $this->Orders->get($id, contain: ['OrderItems.Products']);
            $this->set(compact('order'));
        } catch (Exception $exception) {
            $this->Flash->error(__('Order not found.'));

            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Add method (not used)
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
//        $this->Flash->error(__('Page not found'));
//
//        return $this->redirect(['action' => 'index']);
//        $order = $this->Orders->newEmptyEntity();
//        if ($this->request->is('post')) {
//            $order = $this->Orders->patchEntity($order, $this->request->getData());
//            if ($this->Orders->save($order)) {
//                $this->Flash->success(__('The order has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The order could not be saved. Please, try again.'));
//        }
//        $this->set(compact('order'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        if (!ctype_digit($id)) {
            $this->Flash->error(__('Order not found.'));

            return $this->redirect(['action' => 'index']);
        }
        try {
            $order = $this->Orders->get($id, contain: []);

            // Restrict editing to orders with "pending" status
            if ($order->status !== 'pending') {
                $this->Flash->error(__('Only orders with pending status can be edited.'));

                return $this->redirect(['action' => 'index']);
            }

            if ($this->request->is(['patch', 'post', 'put'])) {
                // Present date
                $now = new DateTime();

                // Order creation date (must be before patch entity)
                $createdDate = $order->created;

                // Get order data from edit form
                $order = $this->Orders->patchEntity($order, $this->request->getData());

                // Edited estimate delivery date
                $estimatedDelivery = $order->estimated_delivery_date;

                // Collect custom errors
                $customErrors = [];

                if ($estimatedDelivery) {
                    // estimate delivery date must be present
                    if ($estimatedDelivery < $now) {
                        $customErrors[] = __('Estimated delivery date cannot be in the past.');
                    }
                    // estimate delivery date must be after creation date
                    if ($createdDate && $estimatedDelivery <= $createdDate) {
                        $customErrors[] = __('Estimated delivery date must be after order creation date.');
                    }
                }

                // If found error in edit form, stop saving, user stays on the edit page
                if (!empty($customErrors)) {
                    foreach ($customErrors as $error) {
                        $this->Flash->error($error);
                    }

                    // If no error found, proceed with saving the edited order
                } elseif ($this->Orders->save($order)) {
                    $this->Flash->success(__('The order has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
            $this->set(compact('order'));
        } catch (Exception $exception) {
            $this->Flash->error(__('Order not found.'));

            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        // Block access to action using GET method
        // Block user to manually access the action (e.g. orders/delete/1 in URL)
        if ($this->request->is('get')) {
            $this->Flash->error(__('Invalid access to delete action'));

            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($order->status === 'cancelled') {
            if ($this->Orders->delete($order)) {
                $this->Flash->success(__('The order has been deleted.'));
            } else {
                $this->Flash->error(__('The order could not be deleted. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('Only cancelled orders can be deleted.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function cancel(?string $id = null)
    {
        // Block access to action using GET method
        // Block user to manually access the action (e.g. orders/cancel/1 in URL)
        if ($this->request->is('get')) {
            $this->Flash->error(__('Invalid access to cancel action'));

            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post']);
        $order = $this->Orders->get($id);

        if ($order->status === 'pending') {
            $order->status = 'cancelled';
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been cancelled.'));
            } else {
                $this->Flash->error(__('The order could not be cancelled. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('Only pending orders can be cancelled.'));
        }

        // TODO: Only admin can cancel order, redirect to index page of orders (admin accessible only)
//        return $this->redirect(['action' => 'customerIndex']);
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Order Lookup method
     * This method allows users to look up their orders using a tracking number.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function orderLookup()
    {
        if ($this->request->is('post')) {
            $trackingNumber = $this->request->getData('tracking_number');

            // Fetch the order by tracking number, including associated order items and products
            $order = $this->Orders->find('all', [
                'conditions' => ['Orders.tracking_number' => $trackingNumber],
                'contain' => ['OrderItems.Products'], // Include related order items and products
            ])->first();

            if ($order) {
                $this->Flash->success(__('Order found.'));
                $this->set(compact('order'));
            } else {
                $this->Flash->error(__('Order not found. Please check your tracking number.'));
            }
        }
    }

    /**
     * Generates a weekly sales report, including total revenue, product performance,
     * and data for a revenue chart. The report is based on a selected week or defaults
     * to the current week if no date is provided.
     *
     * @return void
     * @throws \DateMalformedStringException If the provided date string is invalid.
     */
    public function weeklyReport()
    {
        // Get the selected week or fallback to today
        $selectedWeek = $this->request->getQuery('week');

        // Parse week correctly, if not follow format, fallback to current week
        if (preg_match('/^(\d{4})-W(\d{2})$/', $selectedWeek, $matches)) {
            // Extract ISO year and week
            $year = $matches[1];
            $week = $matches[2];

            // Create DateTime object from year and week
            $selectedDateTime = new DateTime();
            $selectedDateTime->setISODate((int)$year, (int)$week); // Monday of the ISO week
        } else {
            $this->Flash->error(__('Invalid week format.'));
            $selectedDateTime = new DateTime(); // fallback to today
        }

        // Calculate the start and end of the selected week
        $weekStart = (clone $selectedDateTime)->modify('this week')->format('Y-m-d 00:00:00');
        $weekEnd = (clone $selectedDateTime)->modify('sunday this week')->format('Y-m-d 23:59:59');

        // Weekly sales query
        $weeklySales = $this->Orders->find()
            ->matching('OrderItems.Products') // INNER JOIN both tables
            ->where([
                'Orders.created >=' => $weekStart,
                'Orders.created <=' => $weekEnd,
                'Orders.status !=' => 'cancelled',
            ])
            ->select([
                'date' => 'DATE(Orders.created)',
                'revenue' => $this->Orders->find()->func()->sum('OrderItems.quantity * Products.price'),
            ])
            ->groupBy('DATE(Orders.created)')
            ->orderBy(['date' => 'ASC'])
            ->enableAutoFields(false)
            ->toArray();

        // Calculate total revenue for the week
        $weeklyRevenue = array_reduce($weeklySales, function ($sum, $sale) {
            return $sum + $sale->revenue;
        }, 0);

        // Weekly product performance query
        // Step 1: Get product sales data
        $weeklyProductStats = $this->Orders->find()
            ->join([
                'OrderItems' => [
                    'table' => 'order_items',
                    'type' => 'INNER',
                    'conditions' => 'OrderItems.order_id = Orders.id',
                ],
            ])
            ->where([
                'Orders.created >=' => $weekStart,
                'Orders.created <=' => $weekEnd,
                'Orders.status !=' => 'cancelled',
            ])
            ->select([
                'product_id' => 'OrderItems.product_id',
                'total_sales' => $this->Orders->find()->func()->sum('OrderItems.quantity'),
            ])
            ->groupBy('OrderItems.product_id')
            ->orderBy(['total_sales' => 'DESC'])
            ->enableAutoFields(false)
            ->toArray();

        // Step 2: Extract product IDs
        $productIds = array_column($weeklyProductStats, 'product_id');
        $weeklyProducts = [];

        // Step 3: Fetch full Product entities
        if (!empty($productIds)) {
            $products = (new Collection(
                $this->Orders->OrderItems->Products->find()
                    ->where(['id IN' => $productIds])
                    ->all(),
            ))->indexBy('id')->toArray();

            // Step 4: Merge stats with full product entities
            foreach ($weeklyProductStats as $stat) {
                $product = $products[$stat->product_id] ?? null;
                if ($product) {
                    // Dynamically attach stat that not exist in product as virtual field
                    $product->total_sales = $stat->total_sales;
                    // Append product to weeklyProducts array
                    $weeklyProducts[] = $product;
                }
            }
        }

        // Prepare data for the chart
        $chartData = [
            'labels' => array_map(fn($sale) => (new DateTime($sale->date))->format('d/m/Y'), $weeklySales),
            'revenues' => array_map(fn($sale) => $sale->revenue, $weeklySales),
        ];

        // reformat dates for display in view
        $weekStart = (new DateTime($weekStart))->format('D d/m/Y');
        $weekEnd = (new DateTime($weekEnd))->format('D d/m/Y');

        // Pass data to the view
        $this->set(compact('chartData', 'weekStart', 'weekEnd', 'weeklyProducts', 'weeklyRevenue'));
    }

    /**
     * Generates a monthly sales report, including total revenue, product performance,
     * and data for a revenue chart. The report is based on a selected month or defaults
     * to the current month if no date is provided.
     *
     * @return void
     * @throws \DateMalformedStringException If the provided date string is invalid.
     */
    public function monthlyReport()
    {
        // Get the 'month' query (e.g., "2025-02") and default to current month if missing or invalid
        $monthInput = $this->request->getQuery('month');

        if ($monthInput && preg_match('/^\d{4}-\d{2}$/', $monthInput)) {
            // Append "-01" to create a valid date string like "2025-02-01"
            $selectedDateTime = new DateTime($monthInput . '-01');
        } else {
            // Fallback to the first day of the current month
            $this->Flash->error(__('Invalid month format.'));
            $selectedDateTime = new DateTime('first day of this month');
        }

        // Calculate the start and end of the selected month
        $monthStart = (clone $selectedDateTime)->modify('first day of this month')->format('Y-m-d 00:00:00');
        $monthEnd = (clone $selectedDateTime)->modify('last day of this month')->format('Y-m-d 23:59:59');

        // Monthly sales query
        $monthlySales = $this->Orders->find()
            ->matching('OrderItems.Products') // INNER JOIN both tables
            ->where([
                'Orders.created >=' => $monthStart,
                'Orders.created <=' => $monthEnd,
                'Orders.status !=' => 'cancelled',
            ])
            ->select([
                'date' => 'DATE(Orders.created)',
                'revenue' => $this->Orders->find()->func()->sum('OrderItems.quantity * Products.price'),
            ])
            ->groupBy('DATE(Orders.created)')
            ->orderBy(['date' => 'ASC'])
            ->enableAutoFields(false)
            ->toArray();

        // Calculate total revenue for the month
        $monthlyRevenue = array_reduce($monthlySales, function ($sum, $sale) {
            return $sum + $sale->revenue;
        }, 0);

        // Monthly product performance query
        // Step 1: Get product sales data
        $monthlyProductStats = $this->Orders->find()
            ->join([
                'OrderItems' => [
                    'table' => 'order_items',
                    'type' => 'INNER',
                    'conditions' => 'OrderItems.order_id = Orders.id',
                ],
            ])
            ->where([
                'Orders.created >=' => $monthStart,
                'Orders.created <=' => $monthEnd,
                'Orders.status !=' => 'cancelled',
            ])
            ->select([
                'product_id' => 'OrderItems.product_id',
                'total_sales' => $this->Orders->find()->func()->sum('OrderItems.quantity'),
            ])
            ->groupBy('OrderItems.product_id')
            ->orderBy(['total_sales' => 'DESC'])
            ->enableAutoFields(false)
            ->toArray();

        // Step 2: Extract product IDs
        $productIds = array_column($monthlyProductStats, 'product_id');
        $monthlyProducts = [];

        // Step 3: Fetch full Product entities
        if (!empty($productIds)) {
            $products = (new Collection(
                $this->Orders->OrderItems->Products->find()
                    ->where(['id IN' => $productIds])
                    ->all(),
            ))->indexBy('id')->toArray();

            // Step 4: Merge stats with full product entities
            foreach ($monthlyProductStats as $stat) {
                $product = $products[$stat->product_id] ?? null;
                if ($product) {
                    // Dynamically attach stat that not exist in product as virtual field
                    $product->total_sales = $stat->total_sales;
                    // Append product to weeklyProducts array
                    $monthlyProducts[] = $product;
                }
            }
        }

        // Calculate weeks in the month
        $weeks = [];
        $weekPeriods = [];
        $currentWeekStart = new DateTime($monthStart);
        $monthEndDate = new DateTime($monthEnd);

        while ($currentWeekStart <= $monthEndDate) {
            $weekStart = clone $currentWeekStart;
            $weekEnd = clone $currentWeekStart;
            $weekEnd->modify('sunday this week');

            // Adjust week end if it exceeds the month's end
            if ($weekEnd > $monthEndDate) {
                $weekEnd = clone $monthEndDate;
            }

            // Store the week period for revenue calculation
            $weekPeriods[] = [
                'start' => $weekStart->format('Y-m-d'),
                'end' => $weekEnd->format('Y-m-d'),
            ];

            // Format for display
            $weekStartStr = $weekStart->format('d/m/Y');
            $weekEndStr = $weekEnd->format('d/m/Y');
            $weeks[] = "$weekStartStr to $weekEndStr";

            // Move to the next Monday
            $currentWeekStart->modify('next monday');
        }

        // Prepare weekly revenues for the chart
        $weeklyRevenues = [];
        foreach ($weekPeriods as $week) {
            $total = 0;
            foreach ($monthlySales as $sale) {
                if ($sale->date >= $week['start'] && $sale->date <= $week['end']) {
                    $total += $sale->revenue;
                }
            }
            $weeklyRevenues[] = $total;
        }

        // Prepare data for the chart
        $chartData = [
            'labels' => $weeks,
            'revenues' => $weeklyRevenues,
        ];

        // reformat dates for display in view
        $monthStart = (new DateTime($monthStart))->format('d/m/Y');
        $monthEnd = (new DateTime($monthEnd))->format('d/m/Y');

        // Pass data to the view
        $this->set(compact('chartData', 'monthStart', 'monthEnd', 'monthlyProducts', 'monthlyRevenue'));
    }

    /**
     * Generates a yearly sales report, including total revenue, product performance,
     * and data for a revenue chart. The report is based on a selected year or defaults
     * to the current year if no date is provided.
     *
     * @return void
     * @throws \DateMalformedStringException If the provided date string is invalid.
     */
    public function yearlyReport()
    {
        // Get the 'year' query (e.g., "2025") and default to current year if missing or invalid
        $yearInput = $this->request->getQuery('year');

        if ($yearInput && preg_match('/^\d{4}$/', $yearInput)) {
            // Valid year input
            $selectedDateTime = new DateTime($yearInput . '-01-01');
        } else {
            // Fallback to the first day of the current year
            $this->Flash->error(__('Incorrect year format.'));
            $selectedDateTime = new DateTime('first day of January');
        }

        // Calculate the start and end of the selected year
        $yearStart = (clone $selectedDateTime)->modify('first day of January')->format('Y-m-d 00:00:00');
        $yearEnd = (clone $selectedDateTime)->modify('last day of December')->format('Y-m-d 23:59:59');

        // Yearly sales query
        $yearlySales = $this->Orders->find()
            ->matching('OrderItems.Products') // INNER JOIN both tables
            ->where([
                'Orders.created >=' => $yearStart,
                'Orders.created <=' => $yearEnd,
                'Orders.status !=' => 'cancelled',
            ])
            ->select([
                'month' => 'MONTH(Orders.created)',
                'revenue' => $this->Orders->find()->func()->sum('OrderItems.quantity * Products.price'),
            ])
            ->groupBy('MONTH(Orders.created)')
            ->orderBy(['month' => 'ASC'])
            ->enableAutoFields(false)
            ->toArray();

        // Calculate total revenue for the year
        $yearlyRevenue = array_reduce($yearlySales, function ($sum, $sale) {
            return $sum + $sale->revenue;
        }, 0);

        // Yearly product performance query
        // Step 1: Get product sales data
        $yearlyProductStats = $this->Orders->find()
            ->join([
                'OrderItems' => [
                    'table' => 'order_items',
                    'type' => 'INNER',
                    'conditions' => 'OrderItems.order_id = Orders.id',
                ],
            ])
            ->where([
                'Orders.created >=' => $yearStart,
                'Orders.created <=' => $yearEnd,
                'Orders.status !=' => 'cancelled',
            ])
            ->select([
                'product_id' => 'OrderItems.product_id',
                'total_sales' => $this->Orders->find()->func()->sum('OrderItems.quantity'),
            ])
            ->groupBy('OrderItems.product_id')
            ->orderBy(['total_sales' => 'DESC'])
            ->enableAutoFields(false)
            ->toArray();

        // Step 2: Extract product IDs
        $productIds = array_column($yearlyProductStats, 'product_id');
        $yearlyProducts = [];

        // Step 3: Fetch full Product entities
        if (!empty($productIds)) {
            $products = (new Collection(
                $this->Orders->OrderItems->Products->find()
                    ->where(['id IN' => $productIds])
                    ->all(),
            ))->indexBy('id')->toArray();

            // Step 4: Merge stats with full product entities
            foreach ($yearlyProductStats as $stat) {
                $product = $products[$stat->product_id] ?? null;
                if ($product) {
                    // Dynamically attach stat that not exist in product as virtual field
                    $product->total_sales = $stat->total_sales;
                    // Append product to weeklyProducts array
                    $yearlyProducts[] = $product;
                }
            }
        }

        // Prepare data for the chart
        $chartData = [
            'labels' => array_map(fn($sale) => DateTime::createFromFormat('!m', (string)$sale->month)->format('F'), $yearlySales),
            'revenues' => array_map(fn($sale) => $sale->revenue, $yearlySales),
        ];

        // reformat dates for display in view
        $yearStart = (new DateTime($yearStart))->format('d/m/Y');
        $yearEnd = (new DateTime($yearEnd))->format('d/m/Y');

        // Pass data to the view
        $this->set(compact('chartData', 'yearStart', 'yearEnd', 'yearlyProducts', 'yearlyRevenue'));
    }

    // Override the beforeFilter method to allow unauthenticated access to these pages
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['orderLookup']);
    }
}
