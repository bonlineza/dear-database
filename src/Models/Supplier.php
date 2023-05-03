<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SupplierFactory;
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
class Supplier extends DearClient
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'ID' => 'external_guid',
            'Name' => 'name',
            'Currency' => 'currency',
            'PaymentTerm' => 'payment_term',
            'TaxRule' => 'tax_rule',
            'Discount' => 'discount',
            'Comments' => 'comments',
            'AccountPayable' => 'account_payable',
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
            'AttributeSet' => 'attribute_set',
            'Status' => 'status',
            'LastModifiedOn' => 'last_modified_on'
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
        return SupplierFactory::new();
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
            'supplier_addresses',
            'supplier_id',
            'contact_address_id'
        )->onlyNotDeleted()->onlyComplete();
    }
}
