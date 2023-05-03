<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'ID' => 'external_guid',
            'Name' => 'name',
            'IsDeprecated' => 'is_deprecated',
            'IsStaging' => 'is_staging'
        ];
    }
}
