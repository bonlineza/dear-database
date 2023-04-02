<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleFulfilmentFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    protected static function newFactory()
    {
        return SaleFulfilmentFactory::new();
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale'));
    }
}
