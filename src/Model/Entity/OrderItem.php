<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderItem Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Product $product
 */
class OrderItem extends Entity
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
        'order_id' => true,
        'product_id' => true,
        'quantity' => true,
        'unit_price' => true,
        'order' => true,
        'product' => true,
    ];

    // Declare line_price as a virtual field.
    protected array $_virtual = ['line_price'];

    protected function _getLinePrice()
    {
        if (isset($this->unit_price)) {
            return $this->quantity * $this->unit_price;
        }
        // Fallback if unit_price is not set (should never happen if order created correctly)
        if (!empty($this->product) && isset($this->product->price)) {
            return $this->quantity * $this->product->price;
        }

        return 0;
    }
}
