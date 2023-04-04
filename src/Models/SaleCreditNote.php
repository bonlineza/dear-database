<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleCreditNoteFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SaleCreditNote extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    protected $dates = [
        'credit_note_date',
    ];

    public static function getDearFieldTypes(): array
    {
        return [
            "CreditNoteDate" => 'date',
        ];
    }

    public static function getDearMapping(): array
    {
        return [
            "TaskID" => "external_guid",
            "CreditNoteInvoiceNumber" => "credit_note_invoice_number",
            "Memo" => "memo",
            "Status" => "status",
            "CreditNoteDate" => "credit_note_date",
            "CreditNoteNumber" => "credit_note_number",
            "CreditNoteConversionRate" => "credit_note_conversion_rate",
            "TotalBeforeTax" => "total_before_tax",
            "Tax" => "tax",
            "Total" => "total",
        ];
    }

    protected static function newFactory()
    {
        return SaleCreditNoteFactory::new();
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale'));
    }
}
