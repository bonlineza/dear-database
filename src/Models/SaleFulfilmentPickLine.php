<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleFulfilmentPickLineFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleFulfilmentPickLine extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    protected $dates = [
        'expiry_date',
    ];

    public static function getDearFieldTypes(): array
    {
        return [
            "ExpiryDate" => 'date',
        ];
    }

    public static function getDearMapping(): array
    {
        return [
            "ProductID" => "product_guid",
            "SKU" => "sku",
            "Name" => "name",
            "Location" => "location",
            "LocationID" => "location_guid",
            "Quantity" => "quantity",
            "BatchSN" => "batch_sn",
            "ExpiryDate" => "expiry_date",
            "NonInventory" => "non_inventory",
        ];
    }

    protected static function newFactory()
    {
        return SaleFulfilmentPickLineFactory::new();
    }
}
