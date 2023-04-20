<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleFulfilmentPickFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SaleFulfilmentPick extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'Status' => 'status'
        ];
    }

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.sale_fulfilment_pick_line') => [
                'model' => config('dear-database.models.sale_fulfilment_pick_line'),
                'table' => 'sale_fulfilment_pick_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Lines',
            ],
        ];
    }

    protected static function newFactory()
    {
        return SaleFulfilmentPickFactory::new();
    }

    public function saleFulfilmentPickLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_fulfilment_pick_line'));
    }
}
