<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\PurchaseCreditNoteFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PurchaseCreditNote extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'CreditNoteNumber' => 'credit_note_number',
            'CreditNoteDate' => 'credit_note_date',
            'Status' => 'status',
            'TotalBeforeTax' => 'total_before_tax',
            'Tax' => 'tax',
            'Total' => 'total',
        ];
    }

    protected static function newFactory()
    {
        return PurchaseCreditNoteFactory::new();
    }

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.purchase_invoice_line') => [
                'model' => config('dear-database.models.purchase_invoice_line'),
                'table' => 'purchase_invoice_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Lines',
            ],
            config('dear-database.models.purchase_invoice_additional_charge') => [
                'model' => config('dear-database.models.purchase_invoice_additional_charge'),
                'table' => 'purchase_invoice_additional_charges',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'AdditionalCharges',
            ],
            config('dear-database.models.purchase_payment_line') => [
                'model' => config('dear-database.models.purchase_payment_line'),
                'table' => 'purchase_payment_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Refunds',
            ],
            config('dear-database.models.purchase_unstock_line') => [
                'model' => config('dear-database.models.purchase_unstock_line'),
                'table' => 'purchase_unstock_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Unstock',
            ],
        ];
    }

    public function purchaseInvoiceLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.purchase_invoice_line'));
    }

    public function purchaseInvoiceAdditionalCharges(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.purchase_invoice_additional_charge'));
    }

    public function purchasePaymentLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.purchase_payment_line'));
    }

    public function purchaseUnstockLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.purchase_unstock_line'));
    }

    public function purchase(): HasOne
    {
        return $this->hasOne(config('dear-database.models.purchase'));
    }
}
