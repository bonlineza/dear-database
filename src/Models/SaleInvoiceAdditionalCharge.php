<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleInvoiceAdditionalChargeFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoiceAdditionalCharge extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'Description' => 'description',
            'Quantity' => 'quantity',
            'Price' => 'price',
            'Discount' => 'discount',
            'Tax' => 'tax',
            'Total' => 'total',
            'TaxRule' => 'tax_rule',
            'Account' => 'account',
            'Comment' => 'comment'
        ];
    }

    protected static function newFactory()
    {
        return SaleInvoiceAdditionalChargeFactory::new();
    }
}
