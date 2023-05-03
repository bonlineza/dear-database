<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\PurchaseStockFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PurchaseStock extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'Status' => 'status',
        ];
    }

    protected static function newFactory()
    {
        return PurchaseStockFactory::new();
    }

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.purchase_stock_line') => [
                'model' => config('dear-database.models.purchase_stock_line'),
                'table' => 'purchase_stock_lines',
                'relationship_type' => self::$MANY_TO_MANY,
                'dear_key' => 'Lines',
            ],
        ];
    }

    public function purchaseStockLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.purchase_stock_line'));
    }

    public function purchase(): HasOne
    {
        return $this->hasOne(config('dear-database.models.purchase'));
    }
}
