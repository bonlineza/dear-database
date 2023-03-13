<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\InventoryMovementLineFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InventoryMovementLine extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            "TaskID" => "external_guid",
            "ProductID" => "product_guid",
            "Date" => "date",
            "COGS" => "cogs",
        ];
    }

    protected static function newFactory()
    {
        return InventoryMovementLineFactory::new();
    }

    public function purchases(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.purchase'));
    }
}
