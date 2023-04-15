<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleFulfilmentFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SaleFulfilment extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            "TaskID" => "external_guid",
            "FulfillmentNumber" => "sale_fulfilment_number",
            "LinkedInvoiceNumber" => "linked_invoice_number",
            "FulFilmentStatus" => "fulfilment_status",
        ];
    }

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.sale_fulfilment_pick') => [
                'model' => config('dear-database.models.sale_fulfilment_pick'),
                'table' => 'sale_fulfilment_picks',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'Pick',
            ],
            config('dear-database.models.sale_fulfilment_pack') => [
                'model' => config('dear-database.models.sale_fulfilment_pack'),
                'table' => 'sale_fulfilment_packs',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'Pack',
            ],
            config('dear-database.models.sale_fulfilment_ship') => [
                'model' => config('dear-database.models.sale_fulfilment_ship'),
                'table' => 'sale_fulfilment_ships',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'Ship',
            ],
        ];
    }

    protected static function newFactory()
    {
        return SaleFulfilmentFactory::new();
    }

    public function saleFulfilmentPick(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.sale_fulfilment_pick'));
    }

    public function saleFulfilmentPack(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.sale_fulfilment_pack'));
    }

    public function saleFulfilmentShip(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.sale_fulfilment_ship'));
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale'));
    }
}
