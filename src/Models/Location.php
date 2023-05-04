<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Location extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'ID' => 'external_guid',
            'Name' => 'name',
            'IsDefault' => 'is_default',
            'Deprecated' => 'deprecated',
            'FixedAssetsLocation' => 'fixed_assets_location',
            'ParentID' => 'parent_guid',
            'ReferenceCount' => 'reference_count',
            'AddressLine1' => 'address_line1',
            'AddressLine2' => 'address_line2',
            'AddressCitySuburb' => 'address_city_suburb',
            'AddressStateProvince' => 'address_state_province',
            'AddressZipPostCode' => 'address_zip_post_code',
            'AddressCountry' => 'address_country',
            'PickZones' => 'pick_zones',
            'IsShopFloor' => 'is_shop_floor',
            'IsCoMan' => 'is_co_man',
            'IsStaging' => 'is_staging',
        ];
    }

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.bin') => [
                'model' => config('dear-database.models.bin'),
                'table' => 'bins',
                'relationship_type' => self::$MANY_TO_MANY,
                'dear_key' => 'Bins'
            ],
        ];
    }

    public function bins(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.bin'));
    }
}
