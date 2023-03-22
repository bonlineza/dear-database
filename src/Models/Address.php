<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\AddressFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            "DisplayAddressLine1" => "display_address_line1",
            "DisplayAddressLine2" => "display_address_line2",
            "Line1" => "line1",
            "Line2" => "line2",
            "City" => "city",
            "State" => "state",
            "Postcode" => "postcode",
            "Country" => "country"
        ];
    }

    protected static function newFactory()
    {
        return AddressFactory::new();
    }

    public function purchase()
    {
        return $this->hasOne(config('dear-database.models.purchase'));
    }
}
