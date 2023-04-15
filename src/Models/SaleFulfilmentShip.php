<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleFulfilmentShipFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SaleFulfilmentShip extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'Status' => 'status',
            'RequiredBy' => 'required_by',
            'ShippingNotes' => 'shipping_notes'
        ];
    }

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.sale_shipping_address') => [
                'model' => config('dear-database.models.sale_shipping_address'),
                'table' => 'sale_shipping_addresses',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'ShippingAddress',
            ],
            config('dear-database.models.sale_fulfilment_ship_line') => [
                'model' => config('dear-database.models.sale_fulfilment_ship_line'),
                'table' => 'sale_fulfilment_ship_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Lines',
            ],
        ];
    }

    protected static function newFactory()
    {
        return SaleFulfilmentShipFactory::new();
    }

    public function saleShippingAddress(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.sale_shipping_address'));
    }

    public function saleFulfilmentShipLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_fulfilment_ship_line'));
    }
}
