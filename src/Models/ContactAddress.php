<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Enums\ContactAddressType;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $external_guid
 * @property ContactAddressType $type
 */
class ContactAddress extends Model
{
    use HasFactory, DearModel, HasUuids;

    public const PREFIX_DELETED = 'DELETED';

    public const TYPE_BILLING = 'Billing';

    public const TYPE_SHIPPING = 'Shipping';

    public const TYPE_BUSINESS = 'Business';

    protected $guarded = [];

    protected $casts = [
        'type' => ContactAddressType::class,
    ];

    public static function getDearMapping(): array
    {
        return [
            'ID' => 'external_guid',
            'Line1' => 'line1',
            'Line2' => 'line2',
            'City' => 'city',
            'State' => 'state',
            'Country' => 'country',
            'Postcode' => 'post_code',
            'Type' => 'type',
            'DefaultForType' => 'default_for_type'
        ];
    }

    public function scopeOnlyComplete(Builder $query): Builder
    {
        return $query->where(function (Builder $sub) {
            $sub->whereNotNull('line1')
                ->where('line1', '!=', '')
                ->whereNotNull('line2')
                ->where('line2', '!=', '')
                ->whereNotNull('city')
                ->where('city', '!=', '')
                ->whereNotNull('state')
                ->where('state', '!=', '')
                ->whereNotNull('country')
                ->where('country', '!=', '')
                ->whereNotNull('post_code')
                ->where('post_code', '!=', '');
        });
    }

    public function scopeOnlyNotDeleted(Builder $query): Builder
    {
        return $query->where('line2', 'NOT LIKE', self::PREFIX_DELETED . '%');
    }

    public function toDisplayableString(string $delimiter = '\n'): string
    {
        $address_fields = [
            'line1',
            'line2',
            'city',
            'state',
            'country',
            'post_code',
        ];

        $address = '';

        //Only add non-null fields
        foreach ($address_fields as $field) {
            if (isset($this->$field)) {
                $address .= $this->$field . $delimiter;
            }
        }
        //Remove the last delimiter
        return rtrim($address, $delimiter);
    }
}
