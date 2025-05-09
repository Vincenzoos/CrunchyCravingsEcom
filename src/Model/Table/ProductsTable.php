<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsToMany $Categories
 * @method \App\Model\Entity\Product newEmptyEntity()
 * @method \App\Model\Entity\Product newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Product findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Categories', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'categories_products',
        ]);

        $this->hasMany('CartItems', [
            'foreignKey' => 'product_id',
        ]);

        $this->hasMany('OrderItems', [
            'foreignKey' => 'product_id',
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => [
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    return $entity->name . '.' . pathinfo($data->getClientFilename(), PATHINFO_EXTENSION);
                },
                'keepFilesOnDelete' => false,
            ],
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', PRODUCT_NAME_MAX_LENGTH)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->regex('name', '/^[a-zA-Z\s-]+$/', 'Please use only letters, spaces, and hyphens.');

        $validator
            ->scalar('description')
            ->maxLength('description', PRODUCT_DESC_MAX_LENGTH, 'Description must be' . PRODUCT_DESC_MAX_LENGTH . 'characters or less.')
            ->add('description', 'noHtmlTags', [
                'rule' => function ($value, $context) {
                    // Validate by comparing the value with its stripped version.
                    // You can also allow certain tags by providing an allowlist as the second parameter.
                    // For example: strip_tags($value, '<p><br>')
                    return $value === strip_tags($value);
                },
                'message' => 'HTML tags are not allowed in the description.',
            ])
            ->allowEmptyString('description');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->add('price', 'min', [
                'rule' => ['comparison', '>=', 0],
                'message' => 'Price must be greater than or equal to 0.',
            ])
            ->add('price', 'max', [
                'rule' => ['comparison', '<=', PRODUCT_MAX_PRICE],
                'message' => 'Price must be less than or equal to' . PRODUCT_MAX_PRICE . '.',
            ])
            ->notEmptyString('price');

        $validator
            // Allows empty image field
            ->allowEmptyFile('image')
            ->add('image', [
                'validExtension' => [
                    'rule' => ['extension', ['png', 'jpg', 'jpeg', 'webp']],
                    'message' => 'Please upload a valid image file (PNG, JPEG, WEBP).',
                ],
                // Optional: limit to 5MB
                'fileSize' => [
                    'rule' => ['fileSize', '<=', '5MB'],
                    'message' => 'Please upload an image file smaller than 5MB.',
                ],
            ]);

        $validator
            ->integer('quantity')
            ->greaterThanOrEqual('quantity', 0, 'Quantity must be at least 0.')
            ->lessThanOrEqual('quantity', PRODUCT_MAX_QUANTITY, 'Quantity must not exceed' . PRODUCT_MAX_QUANTITY . '.')
            ->allowEmptyString('quantity');

        $validator
            ->scalar('ingredients')
            ->maxLength('ingredients', PRODUCT_INGREDIENTS_MAX_LENGTH, 'Ingredients must be ' . PRODUCT_INGREDIENTS_MAX_LENGTH . ' characters or less.')
            ->add('ingredients', 'allowedCharacters', [
                'rule' => function ($value, $context) {
                    // This regex allows only letters, numbers, spaces, (), comma, period and the "%" symbol.
                    return (bool)preg_match('/^[A-Za-z0-9\s%.,()]+$/', $value);
                },
                'message' => 'Ingredients may only contain letters, numbers, spaces, commas, parenthesis and percentage sign are allowed.',
            ])
            ->add('ingredients', 'noHtmlTags', [
                'rule' => function ($value, $context) {
                    // This ensures no HTML tags are present.
                    return $value === strip_tags($value);
                },
                'message' => 'HTML tags are not allowed in the ingredients.',
            ])
            ->allowEmptyString('ingredients');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['name']), [
            'errorField' => 'name',
            'message' => 'This product name is already in use.',
        ]);

        return $rules;
    }
}
