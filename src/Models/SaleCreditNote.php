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

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.sale_invoice_line') => [
                'model' => config('dear-database.models.sale_invoice_line'),
                'table' => 'sale_invoice_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Lines',
            ],
            config('dear-database.models.sale_invoice_additional_charge') => [
                'model' => config('dear-database.models.sale_invoice_additional_charge'),
                'table' => 'sale_invoice_additional_charges',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'AdditionalCharges',
            ],
            config('dear-database.models.sale_payment_line') => [
                'model' => config('dear-database.models.sale_payment_line'),
                'table' => 'sale_payment_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Refunds',
            ],
            config('dear-database.models.sale_restock_line') => [
                'model' => config('dear-database.models.sale_restock_line'),
                'table' => 'sale_restock_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Restock',
            ],
        ];
    }

    protected static function newFactory()
    {
        return SaleCreditNoteFactory::new();
    }

    public function saleInvoiceLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_invoice_line'));
    }

    public function saleInvoiceAdditionalCharges(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_invoice_additional_charge'));
    }

    public function salePaymentLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_payment_line'));
    }

    public function saleRestockLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_restock_line'));
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale'));
    }
}
