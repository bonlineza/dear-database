<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\PurchaseInvoiceFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PurchaseInvoice extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    protected $dates = [
        'invoice_date',
        'invoice_due_date',
    ];

    public static function getDearFieldTypes(): array
    {
        return [
            "InvoiceDate" => 'date',
            "InvoiceDueDate" => 'date',
        ];
    }

    public static function getDearMapping(): array
    {
        return [
            'InvoiceDate' => 'invoice_date',
            'InvoiceDueDate' => 'invoice_due_date',
            'InvoiceNumber' => 'invoice_number',
            'Status' => 'status',
            'TotalBeforeTax' => 'total_before_tax',
            'Tax' => 'tax',
            'Total' => 'total',
            'Paid' => 'paid',
        ];
    }

    protected static function newFactory()
    {
        return PurchaseInvoiceFactory::new();
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
                'dear_key' => 'Payments',
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

    public function purchase(): HasOne
    {
        return $this->hasOne(config('dear-database.models.purchase'));
    }
}
