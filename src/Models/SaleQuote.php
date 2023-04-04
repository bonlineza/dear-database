<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleQuoteFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SaleQuote extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'Memo' => 'memo',
            'Status' => 'status',
            'TotalBeforeTax' => 'total_before_tax',
            'Tax' => 'tax',
            'Total' => 'total',
        ];
    }

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.sale_payment_line') => [
                'model' => config('dear-database.models.sale_payment_line'),
                'table' => 'sale_payment_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Prepayments',
            ],
            config('dear-database.models.sale_quote_line') => [
                'model' => config('dear-database.models.sale_quote_line'),
                'table' => 'sale_quote_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Lines',
            ],
            config('dear-database.models.sale_additional_charge') => [
                'model' => config('dear-database.models.sale_additional_charge'),
                'table' => 'sale_additional_charges',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'AdditionalCharges',
            ],
        ];
    }

    protected static function newFactory()
    {
        return SaleQuoteFactory::new();
    }

    /**
     * Sale Pre Payment Lines
     */
    public function salePaymentLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_payment_line'));
    }

    public function saleQuoteLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_quote_line'));
    }

    public function saleAdditionalCharges(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_additional_charge'));
    }

    public function sale(): HasOne
    {
        return $this->hasOne(config('dear-database.models.sale'));
    }
}
