<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseStockLine extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    protected $dates = [
        'date',
        'expiry_date'
    ];

    public static function getDearFieldTypes(): array
    {
        return [
            'Date' => 'date',
            'ExpiryDate' => 'date'
        ];
    }

    public static function getDearMapping(): array
    {
        return [
            'Date' => 'date',
            'Quantity' => 'quantity',
            'ProductID' => 'product_guid',
            'SKU' => 'sku',
            'Name' => 'name',
            'Location' => 'location',
            'LocationID' => 'location_guid',
            'Received' => 'received',
            'BatchSN' => 'batchsn',
            'SupplierSKU' => 'supplier_sku',
            'ExpiryDate' => 'expiry_date',
        ];
    }
}
