<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleOrderFactory;
use Bonlineza\DearDatabase\Enums\SaleOrderStatus;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SaleOrder extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    protected $casts = [
        'status' => SaleOrderStatus::class,
    ];

    public static function getDearMapping(): array
    {
        return [
            'SaleOrderNumber' => 'sale_order_number',
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
            config('dear-database.models.sale_order_line') => [
                'model' => config('dear-database.models.sale_order_line'),
                'table' => 'sale_order_lines',
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
        return SaleOrderFactory::new();
    }

    public function saleOrderLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_order_line'));
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
