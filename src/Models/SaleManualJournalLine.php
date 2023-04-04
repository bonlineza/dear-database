<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleManualJournalLineFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleManualJournalLine extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            "Reference" => "reference",
            "Amount" => "amount",
            "Date" => "date",
            "Debit" => "debit",
            "Credit" => "credit"
        ];
    }

    protected static function newFactory()
    {
        return SaleManualJournalLineFactory::new();
    }
}
