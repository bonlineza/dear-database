<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\PurchaseOrderFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PurchaseOrder extends Model
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

    protected static function newFactory()
    {
        return PurchaseOrderFactory::new();
    }

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.purchase_order_line') => [
                'model' => config('dear-database.models.purchase_order_line'),
                'table' => 'purchase_order_lines',
                'relationship_type' => self::$MANY_TO_MANY,
                'dear_key' => 'Lines',
            ],
            config('dear-database.models.purchase_additional_charge') => [
                'model' => config('dear-database.models.purchase_additional_charge'),
                'table' => 'purchase_additional_charges',
                'relationship_type' => self::$MANY_TO_MANY,
                'dear_key' => 'AdditionalCharges',
            ],
            config('dear-database.models.purchase_payment_line') => [
                'model' => config('dear-database.models.purchase_payment_line'),
                'table' => 'purchase_payment_lines',
                'relationship_type' => self::$MANY_TO_MANY,
                'dear_key' => 'Prepayments',
            ],
        ];
    }

    public function purchaseOrderLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.purchase_order_line'));
    }

    public function purchaseAdditionalCharges(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.purchase_additional_charge'));
    }

    /**
     * Purchase Pre Payment Lines
     */
    public function purchasePaymentLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.purchase_payment_line'));
    }

    public function purchase(): HasOne
    {
        return $this->hasOne(config('dear-database.models.purchase'));
    }
}
