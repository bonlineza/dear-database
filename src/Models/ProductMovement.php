<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductMovement extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    protected $dates = [
        'date',
        'expiry_date',
    ];

    public static function getDearFieldTypes(): array
    {
        return [
            "Date" => 'date',
            "ExpiryDate" => 'date',
        ];
    }

    public static function getDearMapping(): array
    {
        return [
            'TaskID' => 'external_guid',
            'Type' => 'type',
            'Date' => 'date',
            'Number' => 'number',
            'Status' => 'status',
            'Quantity' => 'quantity',
            'Amount' => 'amount',
            'Location' => 'location',
            'BatchSN' => 'batch_sn',
            'ExpiryDate' => 'expiry_date',
            'FromTo' => 'from_to',
        ];
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.product'));
    }
}
