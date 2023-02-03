<?php

namespace Bonlineza\DearDatabase\Tests;

use Bonlineza\DearDatabase\Providers\DearDatabaseServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            DearDatabaseServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/create_users_table.php';
        include_once __DIR__ . '/../database/migrations/create_customers_table.php';
        include_once __DIR__ . '/../database/migrations/create_suppliers_table.php';
        include_once __DIR__ . '/../database/migrations/create_contacts_table.php';
        include_once __DIR__ . '/../database/migrations/create_contact_customer_table.php';
        include_once __DIR__ . '/../database/migrations/create_contact_supplier_table.php';
        include_once __DIR__ . '/../database/migrations/create_contact_addresses_table.php';
        include_once __DIR__ . '/../database/migrations/create_customer_addresses_table.php';
        include_once __DIR__ . '/../database/migrations/create_supplier_addresses_table.php';

        (new \CreateUsersTable())->up();
        (new \CreateCustomersTable())->up();
        (new \CreateSuppliersTable())->up();
        (new \CreateContactsTable())->up();
        (new \CreateContactCustomerTable())->up();
        (new \CreateContactSupplierTable())->up();
        (new \CreateContactAddressesTable())->up();
        (new \CreateCustomerAddressesTable())->up();
        (new \CreateSupplierAddressesTable())->up();
    }
}
