<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleAdditionalChargeFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleAdditionalCharge extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'Description' => 'description',
            'Price' => 'price',
            'Quantity' => 'quantity',
            'Discount' => 'discount',
            'Tax' => 'tax',
            'Total' => 'total',
            'TaxRule' => 'tax_rule',
            'Comment' => 'comment'
        ];
    }

    protected static function newFactory()
    {
        return SaleAdditionalChargeFactory::new();
    }
}
