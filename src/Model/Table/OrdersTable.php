<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\OrderProductsTable&\Cake\ORM\Association\HasMany $OrderProducts
 * @method \App\Model\Entity\Order newEmptyEntity()
 * @method \App\Model\Entity\Order newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Order> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Order findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Order> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Order saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Order>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Order>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Order>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Order> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Order>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Order>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Order>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Order> deleteManyOrFail(iterable $entities, array $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('OrderItems', [
            'foreignKey' => 'order_id',
            'dependent' => true, // Deletes related OrderItems when an Order is deleted
            'cascadeCallbacks' => true, // Ensures cascading delete callbacks
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
            ->scalar('tracking_number')
            ->maxLength('tracking_number', TRACKING_NUMBER_MAX_LENGTH)
            ->notEmptyString('tracking_number', 'Tracking number is required.');

        $validator
            ->email('user_email')
            ->notEmptyString('user_email', 'Email is required.');

        $validator
            ->scalar('status')
            ->allowEmptyString('status');

        $validator
            ->scalar('origin_address')
            ->maxLength('origin_address', ORDER_ADDRESS_MAX_LENGTH)
            ->allowEmptyString('origin_address')
            ->add('origin_address', 'validChars', [
            'rule' => ['custom', '/^[\p{L}0-9\s,.\'\/#\-\(\)]+$/u'],
            'message' => 'Only letters, numbers, and basic punctuation are allowed in the address.',
        ]);

        $validator
            ->scalar('destination_address')
            ->maxLength('destination_address', ORDER_ADDRESS_MAX_LENGTH)
            ->notEmptyString('destination_address', 'Destination address is required.')
            ->add('origin_address', 'validChars', [
            'rule' => ['custom', '/^[\p{L}0-9\s,.\'\/#\-\(\)]+$/u'],
            'message' => 'Only letters, numbers, and basic punctuation are allowed in the address.',
        ]);

        $validator
            ->dateTime('estimated_delivery_date')
            ->allowEmptyDateTime('estimated_delivery_date');

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
        return $rules;
    }
}
