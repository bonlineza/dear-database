<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoiceLine extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'ProductID' => 'product_guid',
            'SKU' => 'sku',
            'Name' => 'name',
            'Quantity' => 'quantity',
            'Price' => 'price',
            'Discount' => 'discount',
            'Tax' => 'tax',
            'TaxRule' => 'tax_rule',
            'Account' => 'account',
            'Comment' => 'comment',
            'Total' => 'total',
        ];
    }
}
