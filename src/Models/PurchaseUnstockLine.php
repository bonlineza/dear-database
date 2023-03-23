<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseUnstockLine extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'CardID' => 'external_guid',
            'Date' => 'date',
            'Quantity' => 'quantity',
            'ProductID' => 'product_guid',
            'SKU' => 'sku',
            'Name' => 'name',
            'Location' => 'location',
            'BatchSN' => 'batch_sn',
            'ExpiryDate' => 'expiry_date',
        ];
    }
}
