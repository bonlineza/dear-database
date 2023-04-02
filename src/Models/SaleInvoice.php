<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleInvoiceFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SaleInvoice extends Model
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
            "InvoiceDueDate" => 'date',
            "InvoiceDate" => 'date',
        ];
    }

    public static function getDearMapping(): array
    {
        return [
            "TaskID" => "external_guid",
            "InvoiceNumber" => "invoice_number",
            "Memo" => "memo",
            "Status" => "status",
            "InvoiceDate" => "invoice_date",
            "InvoiceDueDate" => "invoice_due_date",
            "CurrencyConversionRate" => "currency_conversion_rate",
            "BillingAddressLine1" => "billing_address_line_1",
            "BillingAddressLine2" => "billing_address_line_2",
            "LinkedFulfillmentNumber" => "link_fulfilment_number",
            "TotalBeforeTax" => "total_before_tax",
            "Tax" => "tax",
            "Total" => "total",
            "Paid" => "paid",
        ];
    }

    protected static function newFactory()
    {
        return SaleInvoiceFactory::new();
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale'));
    }
}
