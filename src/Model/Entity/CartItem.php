<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CartItem Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Product $product
 */
class CartItem extends Entity
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
        'user_id' => true,
        'product_id' => true,
        'quantity' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'product' => true,
    ];

    // Assuming CartItem entity has 'quantity' and is associated with a Product that has 'price'
    protected function _getLinePrice()
    {
        // Check if the associated product is loaded and has a price
        if (isset($this->_properties['product']['price'])) {
            return $this->_properties['quantity'] * $this->_properties['product']['price'];
        }

        return 0;
    }
}
