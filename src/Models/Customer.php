<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\CustomerFactory;
use Bonlineza\DearDatabase\Models\Contact;
use Bonlineza\DearDatabase\Models\DearClient;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $external_guid
 * @property string $name
 */
class Customer extends DearClient
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'ID' => 'external_guid',
            'Name' => 'name',
            'Status' => 'status',
            'Currency' => 'currency',
            'PaymentTerm' => 'payment_term',
            'AccountReceivable' => 'account_receivable',
            'RevenueAccount' => 'revenue_account',
            'TaxRule' => 'tax_rule',
            'PriceTier' => 'price_tier',
            'Carrier' => 'carrier',
            'SalesRepresentative' => 'sales_representative',
            'Location' => 'location',
            'Discount' => 'discount',
            'Comments' => 'comments',
            'CreditLimit' => 'credit_limit',
            'Tags' => 'tags',
            'AttributeSet' => 'attribute_set',
            'AdditionalAttribute1' => 'additional_attribute_1',
            'AdditionalAttribute2' => 'additional_attribute_2',
            'AdditionalAttribute3' => 'additional_attribute_3',
            'AdditionalAttribute4' => 'additional_attribute_4',
            'AdditionalAttribute5' => 'additional_attribute_5',
            'AdditionalAttribute6' => 'additional_attribute_6',
            'AdditionalAttribute7' => 'additional_attribute_7',
            'AdditionalAttribute8' => 'additional_attribute_8',
            'AdditionalAttribute9' => 'additional_attribute_9',
            'AdditionalAttribute10' => 'additional_attribute_10',
            'LastModifiedOn' => 'last_modified_on',
        ];
    }

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.contact_address') => [
                'model' => config('dear-database.models.contact_address'),
                'table' => 'contact_addresses',
                'relationship_type' => self::$MANY_TO_MANY,
                'dear_key' => 'Addresses'
            ],
            config('dear-database.models.contact') => [
                'model' => config('dear-database.models.contact'),
                'table' => 'contacts',
                'relationship_type' => self::$MANY_TO_MANY,
                'dear_key' => 'Contacts'
            ]
        ];
    }

    protected static function newFactory()
    {
        return CustomerFactory::new();
    }

    public function defaultContact(): ?Contact
    {
        return $this->contacts()->where('default', true)->first();
    }

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.contact'));
    }

    public function contactAddresses(): BelongsToMany
    {
        return $this->belongsToMany(
            config('dear-database.models.contact_address'),
            'customer_addresses',
            'customer_id',
            'contact_address_id'
        )->onlyNotDeleted()->onlyComplete();
    }
}
