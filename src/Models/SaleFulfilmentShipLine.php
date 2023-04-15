<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleFulfilmentShipLineFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleFulfilmentShipLine extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    protected $dates = [
        'shipment_date',
    ];

    public static function getDearFieldTypes(): array
    {
        return [
            "ShipmentDate" => 'date',
        ];
    }

    public static function getDearMapping(): array
    {
        return [
            "ID" => "external_guid",
            "ShipmentDate" => "shipment_date",
            "Carrier" => "carrier",
            "Boxes" => "boxes",
            "TrackingNumber" => "tracking_number",
            "TrackingURL" => "tracking_url",
            "IsShipped" => "is_shipped",
        ];
    }

    protected static function newFactory()
    {
        return SaleFulfilmentShipLineFactory::new();
    }
}
