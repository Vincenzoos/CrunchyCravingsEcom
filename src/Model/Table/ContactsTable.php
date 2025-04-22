<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contacts Model
 *
 * @method \App\Model\Entity\Contact newEmptyEntity()
 * @method \App\Model\Entity\Contact newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Contact> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contact get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Contact findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Contact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Contact> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contact|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Contact saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Contact>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contact>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contact>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contact> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contact>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contact>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Contact>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Contact> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ContactsTable extends Table
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

        $this->setTable('contacts');
        $this->setDisplayField('first_name');
        $this->setPrimaryKey('id');
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
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->requirePresence('first_name', 'create')
            ->add('name', 'validFormat', [
                'rule' => ['custom', '/^[a-zA-Z\s]+$/'],
                'message' => 'Please use only letters and spaces for your first name.',
            ])
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->requirePresence('last_name', 'create')
            ->add('name', 'validFormat', [
                'rule' => ['custom', '/^[a-zA-Z\s]+$/'],
                'message' => 'Please use only letters and spaces for your last name.',
            ])
            ->notEmptyString('last_name');

        $validator
            ->email('email', true, 'Please enter a valid email address.')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 12)
            ->requirePresence('phone_number', 'create')
            ->notEmptyString('phone_number')
            ->add('phone_number', 'validFormat', [
            'rule' => function ($value, $context) {
                // Check if the phone number starts with 0 and does not end with 0 and have 10 digits
                return preg_match('/^0[1-9]\d{0,2} \d{3} \d{3}$/', $value) === 1;
            },
            'message' => 'Please enter a valid phone number starting with 0 (e.g., 0411 256 454).',
        ]);

        $validator
            ->scalar('message')
            ->requirePresence('message', 'create')
            ->maxLength('description', 150, 'Message must be 150 characters or less.')
            ->add('message', 'noHtmlTags', [
                'rule' => function ($value, $context) {
                    // Validate by comparing the value with its stripped version.
                    // You can also allow certain tags by providing an allowlist as the second parameter.
                    // For example: strip_tags($value, '<p><br>')
                    return $value === strip_tags($value);
                },
                'message' => 'HTML tags are not allowed in the message.',
            ])
        ->notEmptyString('message');

        $validator
            ->boolean('replied')
            ->notEmptyString('replied');

        $validator
            ->date('date_sent')
            ->notEmptyDate('date_sent');

        return $validator;
    }
}
