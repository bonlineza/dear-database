<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleOrderFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SaleOrder extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

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

    protected static function newFactory()
    {
        return SaleOrderFactory::new();
    }

    public function sale(): HasOne
    {
        return $this->hasOne(config('dear-database.models.sale'));
    }
}
