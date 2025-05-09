<?php
declare(strict_types=1);

namespace App\Controller;

use DateTime;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 * @property \Authorization\Controller\Component\AuthorizationComponent $Authorization
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

        $this->loadComponent('Authorization.Authorization');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Orders->find()
            ->contain(['Users', 'OrderItems.Products']);
        $orders = $this->paginate($query);

//        // Calculate total_price dynamically for each order
//        foreach ($orders as $order) {
//            $order->total_price = array_reduce($order->order_items, function ($sum, $item) {
//                return $sum + $item->line_price;
//            }, 0);
//        }

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

        $orders = $this->Orders->find('all', [
            'conditions' => ['Orders.user_id' => $userId],
            'contain' => ['OrderItems.Products'], // Include related order items and products
            'order' => ['Orders.created' => 'DESC'],
        ])->toArray();

//        // Calculate total_price dynamically for each order
//        foreach ($orders as $order) {
//            $order->total_price = array_reduce($order->order_items, function ($sum, $item) {
//                return $sum + $item->line_price;
//            }, 0);
//        }

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
        // Calculate total_price dynamically for each order

//        $order->total_price = array_reduce($order->order_items, function ($sum, $item) {
//            return $sum + $item->line_price;
//        }, 0);

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

    public function salesReport()
    {
        $this->OrderItems = $this->fetchTable('OrderItems');
        $this->Products = $this->fetchTable('Products');

        // Get the current date
        $now = new DateTime();

        // Filter data for week, month, and year
        $weekStart = $now->modify('-1 week')->format('Y-m-d H:i:s');
        $monthStart = $now->modify('-1 month')->format('Y-m-d H:i:s');
        $yearStart = $now->modify('-1 year')->format('Y-m-d H:i:s');

        // Weekly sales
        $weeklySales = $this->Orders->find()
            ->join([
                'OrderItems' => [
                    'table' => 'order_items',
                    'type' => 'INNER',
                    'conditions' => 'OrderItems.order_id = Orders.id',
                ],
                'Products' => [
                    'table' => 'products',
                    'type' => 'INNER',
                    'conditions' => 'Products.id = OrderItems.product_id',
                ],
            ])
            ->where(['Orders.created >=' => $weekStart])
            ->select([
                'product_id' => 'OrderItems.product_id',
                'product_name' => 'Products.name',
                'total_sales' => 'SUM(OrderItems.quantity)',
            ])
            ->groupBy('OrderItems.product_id')
            ->orderBy(['total_sales' => 'DESC'])
            ->toArray();

        // Monthly sales
        $monthlySales = $this->Orders->find()
            ->join([
                'OrderItems' => [
                    'table' => 'order_items',
                    'type' => 'INNER',
                    'conditions' => 'OrderItems.order_id = Orders.id',
                ],
                'Products' => [
                    'table' => 'products',
                    'type' => 'INNER',
                    'conditions' => 'Products.id = OrderItems.product_id',
                ],
            ])
            ->where(['Orders.created >=' => $monthStart])
            ->select([
                'product_id' => 'OrderItems.product_id',
                'product_name' => 'Products.name',
                'total_sales' => 'SUM(OrderItems.quantity)',
            ])
            ->groupBy('OrderItems.product_id')
            ->orderBy(['total_sales' => 'DESC'])
            ->toArray();

        // Yearly sales
        $yearlySales = $this->Orders->find()
            ->join([
                'OrderItems' => [
                    'table' => 'order_items',
                    'type' => 'INNER',
                    'conditions' => 'OrderItems.order_id = Orders.id',
                ],
                'Products' => [
                    'table' => 'products',
                    'type' => 'INNER',
                    'conditions' => 'Products.id = OrderItems.product_id',
                ],
            ])
            ->where(['Orders.created >=' => $yearStart])
            ->select([
                'product_id' => 'OrderItems.product_id',
                'product_name' => 'Products.name',
                'total_sales' => 'SUM(OrderItems.quantity)',
            ])
            ->groupBy('OrderItems.product_id')
            ->orderBy(['total_sales' => 'DESC'])
            ->toArray();

        // Pass data to the view
        $this->set(compact('weeklySales', 'monthlySales', 'yearlySales'));
    }
}
