<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAvailability extends Model
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
            'ID' => 'product_guid',
            'SKU' => 'sku',
            'Name' => 'name',
            'Barcode' => 'barcode',
            'Location' => 'location',
            'Bin' => 'bin',
            'Batch' => 'batch',
            'ExpiryDate' => 'expiry_date',
            'OnHand' => 'on_hand',
            'Allocated' => 'allocated',
            'Available' => 'available',
            'OnOrder' => 'on_order',
            'StockOnHand' => 'stock_on_hand',
            'InTransit' => 'in_transit',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.product'));
    }
}
