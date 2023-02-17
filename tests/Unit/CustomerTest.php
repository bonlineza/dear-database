<?php

namespace Bonlineza\DearDatabase\Tests\Unit;

use Bonlineza\DearDatabase\Models\Contact;
use Bonlineza\DearDatabase\Models\ContactAddress;
use Bonlineza\DearDatabase\Models\Customer;
use Bonlineza\DearDatabase\Models\User;
use Bonlineza\DearDatabase\Tests\TestCase;

class CustomerTest extends TestCase
{
    public const CUSTOMER_GUID = 'f98fe45a-8125-4407-a652-fa112db27af8';

    /** @test */
    function customer_create_from_dear()
    {
        $dear_customer = json_decode(
            file_get_contents(
                sprintf(
                    '%s/../Stubs/Dear/Customer/%s.json',
                    __DIR__,
                    self::CUSTOMER_GUID
                )
            ),
            true
        );

        $customer = Customer::createFromDear($dear_customer['CustomerList'][0]);

        foreach (Customer::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_customer['CustomerList'][0][$dear_key], $customer->$db_key);
        }

        $contact_guids = array_column($dear_customer['CustomerList'][0]['Contacts'], 'ID');
        foreach ($contact_guids as $key => $contact_guid) {
            $db_contact = $customer->contacts()->where('external_guid', $contact_guid)->first();
            $dear_contact = $dear_customer['CustomerList'][0]['Contacts'][$key];
            foreach (Contact::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_contact[$dear_key], $db_contact->$db_key);
            }
        }

        $address_guids = array_column($dear_customer['CustomerList'][0]['Addresses'], 'ID');
        foreach ($address_guids as $key => $address_guid) {
            $db_address = $customer->contactAddresses()->where('external_guid', $address_guid)->first();
            $dear_address = $dear_customer['CustomerList'][0]['Addresses'][$key];
            foreach (ContactAddress::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_address[$dear_key], $db_address->$db_key);
            }
        }
    }

    /** @test */
    function customer_update_from_dear()
    {
        $dear_customer = json_decode(
            file_get_contents(
                sprintf(
                    '%s/../Stubs/Dear/Customer/%s.json',
                    __DIR__,
                    self::CUSTOMER_GUID
                )
            ),
            true
        );

        $customer = Customer::factory()->create();
        $customer->updateFromDear($dear_customer['CustomerList'][0]);

        foreach (Customer::getDearMapping() as $dear_key => $db_key) {
            $this->assertEquals($dear_customer['CustomerList'][0][$dear_key], $customer->$db_key);
        }

        $contact_guids = array_column($dear_customer['CustomerList'][0]['Contacts'], 'ID');
        foreach ($contact_guids as $key => $contact_guid) {
            $db_contact = $customer->contacts()->where('external_guid', $contact_guid)->first();
            $dear_contact = $dear_customer['CustomerList'][0]['Contacts'][$key];
            foreach (Contact::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_contact[$dear_key], $db_contact->$db_key);
            }
        }

        $address_guids = array_column($dear_customer['CustomerList'][0]['Addresses'], 'ID');
        foreach ($address_guids as $key => $address_guid) {
            $db_address = $customer->contactAddresses()->where('external_guid', $address_guid)->first();
            $dear_address = $dear_customer['CustomerList'][0]['Addresses'][$key];
            foreach (ContactAddress::getDearMapping() as $dear_key => $db_key) {
                $this->assertEquals($dear_address[$dear_key], $db_address->$db_key);
            }
        }
    }

    /** @test */
    function customer_sync_client_to_user()
    {
        $dear_customer = json_decode(
            file_get_contents(
                sprintf(
                    '%s/../Stubs/Dear/Customer/%s.json',
                    __DIR__,
                    self::CUSTOMER_GUID
                )
            ),
            true
        );
        $customer_email = $dear_customer['CustomerList'][0]['Name'];

        $customer = Customer::factory()->create([
            'name' => $customer_email,
        ]);

        $contact = $customer->defaultContact();
        $contact->user_id = null;
        $contact->save();

        $user = User::where('email', $customer_email)->first();

        $this->assertNull($user->getCustomer());

        $customer = Customer::syncClientToUser($customer);

        $this->assertEquals($customer->defaultContact()->user_id, $user->id);
    }
}
