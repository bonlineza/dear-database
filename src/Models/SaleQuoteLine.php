<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleQuoteLineFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleQuoteLine extends Model
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
            'AverageCost' => 'average_cost',
            'TaxRule' => 'tax_rule',
            'Comment' => 'comment',
            'Total' => 'total'
        ];
    }

    protected static function newFactory()
    {
        return SaleQuoteLineFactory::new();
    }
}
