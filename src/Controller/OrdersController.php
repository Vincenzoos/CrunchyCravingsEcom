<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Collection\Collection;
use DateTime;

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
            ->contain(['Users', 'OrderItems.Products'])
            ->orderBy(['Orders.created' => 'DESC']);
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
        $userId = $this->request->getAttribute('identity')->id;
        $user = $this->Orders->Users->get($userId);
        $userEmail = $user->email ?? null;

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
        $order = $this->Orders->get($id, contain: ['Users', 'OrderItems.Products']);
        $this->set(compact('order'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', limit: 200)->all();
        $this->set(compact('order', 'users'));
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
        $order = $this->Orders->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', limit: 200)->all();
        $this->set(compact('order', 'users'));
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
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

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
    
            // Fetch the order by tracking number
            $order = $this->Orders->find('all', [
                'conditions' => ['Orders.tracking_number' => $trackingNumber],
            ])->first();
    
            if ($order) {
                $this->set(compact('order'));
            } else {
                $this->set('error', __('Order not found. Please check your tracking number.'));
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
        // Get the selected date from the query or default to today
        $selectedWeek = $this->request->getQuery('week') ?? (new DateTime())->format('Y-m-d');
        $selectedDateTime = new DateTime($selectedWeek);

        // Calculate the start and end of the selected week
        $weekStart = (clone $selectedDateTime)->modify('this week')->format('Y-m-d 00:00:00');
        $weekEnd = (clone $selectedDateTime)->modify('sunday this week')->format('Y-m-d 23:59:59');

        // Weekly sales query
        $weeklySales = $this->Orders->find()
            ->matching('OrderItems.Products') // INNER JOIN both tables
            ->where([
                'Orders.created >=' => $weekStart,
                'Orders.created <=' => $weekEnd,
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
            ->where(['Orders.created >=' => $weekStart, 'Orders.created <=' => $weekEnd])
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
        // Get the selected date from the query or default to today
        $selectedMonth = $this->request->getQuery('month') ?? (new DateTime('first day of this month'))->format('Y-m-d');
        $selectedDateTime = new DateTime($selectedMonth);

        // Calculate the start and end of the selected month
        $monthStart = (clone $selectedDateTime)->modify('first day of this month')->format('Y-m-d 00:00:00');
        $monthEnd = (clone $selectedDateTime)->modify('last day of this month')->format('Y-m-d 23:59:59');

        // Monthly sales query
        $monthlySales = $this->Orders->find()
            ->matching('OrderItems.Products') // INNER JOIN both tables
            ->where([
                'Orders.created >=' => $monthStart,
                'Orders.created <=' => $monthEnd,
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
            ->where(['Orders.created >=' => $monthStart, 'Orders.created <=' => $monthEnd])
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
        $currentWeekStart = new DateTime($monthStart);
        while ($currentWeekStart->format('Y-m-d') <= (new DateTime($monthEnd))->format('Y-m-d')) {
            $weekStart = $currentWeekStart->format('d/m/Y');
            $weekEnd = (clone $currentWeekStart)->modify('sunday this week')->format('d/m/Y');

            // Ensure weekEnd does not exceed the month's end
            if ($weekEnd < $monthEnd) {
                $weekEnd = (new DateTime($monthEnd))->format('d/m/Y');
            }
            $weeks[] = "$weekStart to $weekEnd";
            $currentWeekStart->modify('next monday');
        }

        // Prepare data for the chart
        $chartData = [
            'labels' => $weeks,
            'revenues' => array_map(fn($sale) => $sale->revenue, $monthlySales),
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
        // Get the selected date from the query or default to today
        $selectedYear = $this->request->getQuery('year') ?? (new DateTime('first day of this year'))->format('Y');
        $selectedYear = $selectedYear . '-01-01';
        $selectedDateTime = new DateTime($selectedYear);

        // Calculate the start and end of the selected year
        $yearStart = (clone $selectedDateTime)->modify('first day of January')->format('Y-m-d 00:00:00');
        $yearEnd = (clone $selectedDateTime)->modify('last day of December')->format('Y-m-d 23:59:59');

        // Yearly sales query
        $yearlySales = $this->Orders->find()
            ->matching('OrderItems.Products') // INNER JOIN both tables
            ->where([
                'Orders.created >=' => $yearStart,
                'Orders.created <=' => $yearEnd,
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
            ->where(['Orders.created >=' => $yearStart, 'Orders.created <=' => $yearEnd])
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
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['orderLookup']);
    }
}
