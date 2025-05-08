<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'status' => 'pending',
                'origin_address' => '123 Warehouse St, Melbourne, VIC',
                'destination_address' => '456 Customer Rd, Sydney, NSW',
                'shipped_date' => '2025-05-06 10:00:00',
                'estimated_delivery_date' => '2025-05-10 18:00:00',
                'created' => '2025-05-07 01:56:18',
                'modified' => '2025-05-07 01:56:18',
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'status' => 'shipped',
                'origin_address' => '789 Supplier Ln, Brisbane, QLD',
                'destination_address' => '123 Customer Ave, Perth, WA',
                'shipped_date' => '2025-05-05 09:00:00',
                'estimated_delivery_date' => '2025-05-09 17:00:00',
                'created' => '2025-05-05 08:00:00',
                'modified' => '2025-05-05 08:30:00',
            ],
        ];
        parent::init();
    }
}