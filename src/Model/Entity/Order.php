<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $user_email
 * @property string $total_price
 * @property string|null $status
 * @property string|null $origin_address
 * @property string|null $destination_address
 * @property \Cake\I18n\DateTime|null $shipped_date
 * @property \Cake\I18n\DateTime|null $estimated_delivery_date
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\OrderProduct[] $order_products
 */
class Order extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'tracking_number' => true,
        'user_email' => true,
        'total_price' => false,
        'status' => true,
        'origin_address' => true,
        'destination_address' => true,
        'shipped_date' => true,
        'estimated_delivery_date' => true,
        'created' => false,
        'modified' => true,
        'user' => true,
        'order_products' => true,
        'return_status' => true,
    ];

    // Declare total_price as a virtual field.
    protected array $_virtual = ['total_price'];

    /**
     * Calculate the total price of the order based on its order items.
     *
     * @return float
     */
    protected function _getTotalPrice(): float
    {
        if (!empty($this->order_items)) {
            return array_reduce($this->order_items, function ($sum, $item) {
                return $sum + $item->line_price;
            }, 0);
        }

        return 0.0;
    }
}
