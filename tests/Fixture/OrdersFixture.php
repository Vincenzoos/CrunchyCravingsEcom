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
                'total_price' => 1.5,
                'status' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-05-07 01:56:18',
                'modified' => '2025-05-07 01:56:18',
            ],
        ];
        parent::init();
    }
}
