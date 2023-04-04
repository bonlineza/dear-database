<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SalePaymentLineFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePaymentLine extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    protected $dates = [
        'date_paid',
        'date_created'
    ];

    public static function getDearFieldTypes(): array
    {
        return [
            'DatePaid' => 'date',
            'DateCreated' => 'date'
        ];
    }

    public static function getDearMapping(): array
    {
        return [
            'ID' => 'external_guid',
            'Reference' => 'reference',
            'Amount' => 'amount',
            'DatePaid' => 'date_paid',
            'Account' => 'account',
            'CurrencyRate' => 'currency_rate',
            'DateCreated' => 'date_created',
        ];
    }

    protected static function newFactory()
    {
        return SalePaymentLineFactory::new();
    }
}
