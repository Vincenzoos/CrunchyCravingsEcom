<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Inventories Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\Inventory newEmptyEntity()
 * @method \App\Model\Entity\Inventory newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Inventory> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Inventory get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Inventory findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Inventory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Inventory> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Inventory|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Inventory saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Inventory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Inventory>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Inventory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Inventory> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Inventory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Inventory>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Inventory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Inventory> deleteManyOrFail(iterable $entities, array $options = [])
 */
class InventoriesTable extends Table
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

        $this->setTable('inventories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
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
            ->integer('product_id')
            ->notEmptyString('product_id');

        $validator
            ->integer('total_quantity')
            ->requirePresence('total_quantity', 'create')
            ->notEmptyString('total_quantity');

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
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }
}
