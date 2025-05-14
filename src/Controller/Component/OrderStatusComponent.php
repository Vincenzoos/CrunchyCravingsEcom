<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Datasource\ConnectionManager;

class OrderStatusComponent extends Component
{
    public function updateStatuses(): void
    {
        // Use SQL query rather than CakePHP ORM for efficient and fast mass updates
        $connection = ConnectionManager::get('default');

        // 1. Reset shipped orders with null shipped_date back to pending
        $connection->execute("
            UPDATE orders
            SET status = 'pending', shipped_date = NULL
            WHERE status = 'shipped' AND shipped_date IS NULL
        ");

        // 2. Mark as shipped after 2 days from created
        $connection->execute("
        UPDATE orders
        SET status = 'shipped', shipped_date = NOW()
        WHERE status = 'pending' AND created <= DATE_SUB(NOW(), INTERVAL 2 DAY)
        ");

        // 3. Mark as completed after 14 days from created
        $connection->execute("
        UPDATE orders
        SET status = 'completed'
        WHERE status = 'shipped' AND created <= DATE_SUB(NOW(), INTERVAL 14 DAY)
        ");
    }
}
