<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseAdditionalCharge extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'Description' => 'description',
            'Reference' => 'reference',
            'Price' => 'price',
            'Quantity' => 'quantity',
            'Discount' => 'discount',
            'Tax' => 'tax',
            'Total' => 'total',
            'TaxRule' => 'tax_rule',
        ];
    }
}
