<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactsTable Test Case
 */
class ContactsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactsTable
     */
    protected $Contacts;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Contacts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Contacts') ? [] : ['className' => ContactsTable::class];
        $this->Contacts = $this->getTableLocator()->get('Contacts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Contacts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ContactsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
