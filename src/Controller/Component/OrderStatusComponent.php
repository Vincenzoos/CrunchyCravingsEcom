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

        // 1. Reset shipped orders with null estimated_delivery_date back to pending
        $connection->execute("
            UPDATE orders
            SET status = 'pending', estimated_delivery_date = NULL
            WHERE status = 'shipped' AND estimated_delivery_date IS NULL
        ");

        // 2. Auto-ship orders after 2 days if no estimated_delivery_date (Crunchy Cravings Policy)
        $connection->execute("
            UPDATE orders
            SET status = 'shipped', estimated_delivery_date = NOW()
            WHERE status = 'pending' AND estimated_delivery_date IS NULL AND created <= DATE_SUB(NOW(), INTERVAL 2 DAY)
        ");

        // 3. Ship orders scheduled by admin (Shipping delayed, not follow policy)
        $connection->execute("
            UPDATE orders
            SET status = 'shipped'
            WHERE status = 'pending' AND NOW() >= estimated_delivery_date
        ");

        // 4. Mark as completed after 14 days from created
        $connection->execute("
            UPDATE orders
            SET status = 'completed'
            WHERE status = 'shipped' AND created <= DATE_SUB(NOW(), INTERVAL 14 DAY)
        ");

    }
}
