<?php

namespace Bonlineza\DearDatabase\Tests\Unit;

use Bonlineza\DearDatabase\Models\Contact;
use Bonlineza\DearDatabase\Models\ContactAddress;
use Bonlineza\DearDatabase\Models\Supplier;
use Bonlineza\DearDatabase\Models\User;
use Bonlineza\DearDatabase\Tests\TestCase;

class SupplierTest extends TestCase
{
    public const SUPPLIER_GUID = '2245481a-7a00-4512-a772-c6928a5ad1ed';

    /** @test */
    function supplier_create_from_dear()
    {
        $dear_supplier = json_decode(
            file_get_contents(
                sprintf(
                    '%s/../Stubs/Dear/Supplier/%s.json',
                    __DIR__,
                    self::SUPPLIER_GUID
                )
            ),
            true
        );

        $supplier = Supplier::createFromDear($dear_supplier['SupplierList'][0]);

        foreach (Supplier::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_supplier['SupplierList'][0][$dear_key], $supplier->$db_key);
        }

        $contact_guids = array_column($dear_supplier['SupplierList'][0]['Contacts'], 'ID');
        foreach ($contact_guids as $key => $contact_guid) {
            $db_contact = $supplier->contacts()->where('external_guid', $contact_guid)->first();
            $dear_contact = $dear_supplier['SupplierList'][0]['Contacts'][$key];
            foreach (Contact::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_contact[$dear_key], $db_contact->$db_key);
            }
        }

        $address_guids = array_column($dear_supplier['SupplierList'][0]['Addresses'], 'ID');
        foreach ($address_guids as $key => $address_guid) {
            /** @var ContactAddress $db_address */
            $db_address = $supplier->contactAddresses()->where('external_guid', $address_guid)->first();
            $dear_address = $dear_supplier['SupplierList'][0]['Addresses'][$key];
            foreach (ContactAddress::getDearMapping() as $dear_key => $db_key) {
                if ($db_key === 'type') {
                    $this->assertEquals($dear_address[$dear_key], $db_address->$db_key->value);
                    continue;
                }
                $this->assertEquals($dear_address[$dear_key], $db_address->$db_key);
            }
        }
    }

    /** @test */
    function supplier_update_from_dear()
    {
        $dear_supplier = json_decode(
            file_get_contents(
                sprintf(
                    '%s/../Stubs/Dear/Supplier/%s.json',
                    __DIR__,
                    self::SUPPLIER_GUID
                )
            ),
            true
        );

        $supplier = Supplier::factory()->create();
        $supplier->updateFromDear($dear_supplier['SupplierList'][0]);

        foreach (Supplier::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_supplier['SupplierList'][0][$dear_key], $supplier->$db_key);
        }

        $contact_guids = array_column($dear_supplier['SupplierList'][0]['Contacts'], 'ID');
        foreach ($contact_guids as $key => $contact_guid) {
            $db_contact = $supplier->contacts()->where('external_guid', $contact_guid)->first();
            $dear_contact = $dear_supplier['SupplierList'][0]['Contacts'][$key];
            foreach (Contact::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_contact[$dear_key], $db_contact->$db_key);
            }
        }

        $address_guids = array_column($dear_supplier['SupplierList'][0]['Addresses'], 'ID');
        foreach ($address_guids as $key => $address_guid) {
            /** @var ContactAddress $db_address */
            $db_address = $supplier->contactAddresses()->where('external_guid', $address_guid)->first();
            $dear_address = $dear_supplier['SupplierList'][0]['Addresses'][$key];
            foreach (ContactAddress::getDearMapping() as $dear_key => $db_key) {
                if ($db_key === 'type') {
                    $this->assertEquals($dear_address[$dear_key], $db_address->$db_key->value);
                    continue;
                }
                $this->assertEquals($dear_address[$dear_key], $db_address->$db_key);
            }
        }
    }

    /** @test */
    function supplier_sync_client_to_user()
    {
        $dear_supplier = json_decode(
            file_get_contents(
                sprintf(
                    '%s/../Stubs/Dear/Supplier/%s.json',
                    __DIR__,
                    self::SUPPLIER_GUID
                )
            ),
            true
        );
        $supplier_email = $dear_supplier['SupplierList'][0]['Name'];

        $supplier = Supplier::factory()->create([
            'name' => $supplier_email,
        ]);

        $contact = $supplier->defaultContact();
        $contact->user_id = null;
        $contact->save();

        $user = User::where('email', $supplier_email)->first();

        $this->assertNull($user->getSupplier());

        $supplier = Supplier::syncClientToUser($supplier);

        $this->assertEquals($supplier->defaultContact()->user_id, $user->id);
    }
}
