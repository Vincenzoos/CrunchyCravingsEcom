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

    public function weeklyReport()
    {
        // Get the selected date from the query or default to today
        $selectedWeek = $this->request->getQuery('week') ?? (new DateTime())->format('Y-m-d');
        $selectedDateTime = new DateTime($selectedWeek);

        // Calculate the start and end of the selected week
        $weekStart = (clone $selectedDateTime)->modify('this week')->format('Y-m-d 00:00:00');
        $weekEnd = (clone $selectedDateTime)->modify('this week +6 days')->format('Y-m-d 23:59:59');

        // Weekly sales query
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
            ->where(['Orders.created >=' => $weekStart, 'Orders.created <=' => $weekEnd])
            ->select([
                'date' => 'DATE(Orders.created)',
                'revenue' => 'SUM(OrderItems.quantity * Products.price)',
            ])
            ->groupBy('DATE(Orders.created)')
            ->orderBy(['date' => 'ASC'])
            ->toArray();

        // Calculate total revenue for the week
        $weeklyRevenue = array_reduce($weeklySales, function ($sum, $sale) {
            return $sum + $sale->revenue;
        }, 0);

        // Weekly product performance query
        $weeklyProducts = $this->Orders->find()
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
            ->where(['Orders.created >=' => $weekStart, 'Orders.created <=' => $weekEnd])
            ->select([
                'product_id' => 'OrderItems.product_id',
                'product_name' => 'Products.name',
                'total_sales' => 'SUM(OrderItems.quantity)',
            ])
            ->groupBy('OrderItems.product_id')
            ->orderBy(['total_sales' => 'DESC'])
            ->toArray();

        // Pass data to the view
        $this->set(compact('weekStart', 'weekEnd', 'weeklySales', 'weeklyProducts','weeklyRevenue'));
    }
}
