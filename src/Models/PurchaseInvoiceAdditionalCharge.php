<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoiceAdditionalCharge extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'Description' => 'description',
            'Reference' => 'reference',
            'Quantity' => 'quantity',
            'Price' => 'price',
            'Discount' => 'discount',
            'Tax' => 'tax',
            'TaxRule' => 'tax_rule',
            'Account' => 'account',
            'Total' => 'total',
        ];
    }
}
