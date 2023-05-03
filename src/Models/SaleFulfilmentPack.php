<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleFulfilmentPackFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SaleFulfilmentPack extends Model
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
            config('dear-database.models.sale_fulfilment_pack_line') => [
                'model' => config('dear-database.models.sale_fulfilment_pack_line'),
                'table' => 'sale_fulfilment_pack_lines',
                'relationship_type' => self::$MANY_TO_MANY,
                'dear_key' => 'Lines',
            ],
        ];
    }

    protected static function newFactory()
    {
        return SaleFulfilmentPackFactory::new();
    }

    public function saleFulfilmentPackLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_fulfilment_pack_line'));
    }
}
