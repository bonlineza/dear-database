<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleFulfilmentShipFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleFulfilmentShip extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    protected $dates = [
        'require_by',
    ];

    public static function getDearFieldTypes(): array
    {
        return [
            "RequireBy" => 'date',
        ];
    }

    public static function getDearMapping(): array
    {
        return [
            'Status' => 'status',
            'RequireBy' => 'require_by',
            'ShippingNotes' => 'shipping_notes'
        ];
    }

    protected static function newFactory()
    {
        return SaleFulfilmentShipFactory::new();
    }
}
