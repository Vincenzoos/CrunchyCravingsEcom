<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property string $image
 * @property int $quantity
 *
 * @property \App\Model\Entity\Category[] $categories
 */
class Product extends Entity
{
    protected array $_virtual = ['image_name', 'image_full_path'];

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
        'name' => true,
        'description' => true,
        'price' => true,
        'image' => true,
        'quantity' => true,
        'categories' => true,
    ];

    /**
     * A virtual field for setting uploaded image name
     *
     * @return string
     */
    protected function _getImageName(): string
    {
        return $this->name;
    }

    /**
     * A virtual field for getting full path of image
     *
     * @return string
     */
    protected function _getImageFullPath(): string
    {
        if (is_string($this->image) && !empty($this->image)) {
            return '/files/Products/image/' . $this->image;
        }
        // Fallback to a default image if it's still an object, or no file was uploaded.
        return '/files/Products/image/default-product.jpg';
    }
}
