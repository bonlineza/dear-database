<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\SaleFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    protected $dates = [
        'sale_order_date',
        'last_modified_on',
        'ship_by'
    ];

    public static function getDearFieldTypes(): array
    {
        return [
            "SaleOrderDate" => 'date',
            "LastModifiedOn" => 'date',
            "ShipBy" => 'date',
        ];
    }

    public static function getDearMapping(): array
    {
        return [
            'ID' => 'external_guid',
            'Customer' => 'customer',
            'CustomerID' => 'customer_guid',
            "Contact" => "contact",
            "Phone" => "phone",
            "Email" => "email",
            "DefaultAccount" => "default_account",
            "SkipQuote" => "skip_quote",
            'ShippingNotes' => 'shipping_notes',
            'BaseCurrency' => 'base_currency',
            'CustomerCurrency' => 'customer_currency',
            "TaxRule" => "tax_rule",
            "TaxCalculation" => "tax_calculation",
            "Terms" => "terms",
            "PriceTier" => "price_tier",
            'ShipBy' => 'ship_by',
            "Location" => "location",
            "SaleOrderDate" => "sale_order_date",
            "LastModifiedOn" => "last_modified_on",
            "Note" => "note",
            'CustomerReference' => 'customer_reference',
            "COGSAmount" => "cogs_amount",
            "Status" => "status",
            'CombinedPickingStatus' => 'combined_picking_status',
            'CombinedPackingStatus' => 'combined_packing_status',
            'CombinedShippingStatus' => 'combined_shipping_status',
            'FulFilmentStatus' => 'fulfilment_status',
            'CombinedInvoiceStatus' => 'combined_invoice_status',
            'CombinedPaymentStatus' => 'combined_payment_status',
            'CombinedTrackingNumbers' => 'combined_tracking_numbers',
            "Carrier" => "carrier",
            "CurrencyRate" => "currency_rate",
            "SalesRepresentative" => "sales_representative",
            'Type' => 'type',
            'SourceChannel' => 'source_channel',
            "ExternalID" => "external_id",
            "ServiceOnly" => "service_only",
        ];
    }

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.address') => [
                'model' => config('dear-database.models.address'),
                'table' => 'addresses',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'BillingAddress',
            ],
            config('dear-database.models.sale_shipping_address') => [
                'model' => config('dear-database.models.sale_shipping_address'),
                'table' => 'sale_shipping_addresses',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'ShippingAddress',
            ],
            config('dear-database.models.sale_quote') => [
                'model' => config('dear-database.models.sale_quote'),
                'table' => 'sale_quotes',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'Quote',
            ],
            config('dear-database.models.sale_order') => [
                'model' => config('dear-database.models.sale_order'),
                'table' => 'sale_orders',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'Order',
            ],
            config('dear-database.models.sale_manual_journal') => [
                'model' => config('dear-database.models.sale_manual_journal'),
                'table' => 'sale_manual_journals',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'ManualJournals',
            ],
            config('dear-database.models.additional_attribute') => [
                'model' => config('dear-database.models.additional_attribute'),
                'table' => 'additional_attributes',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'AdditionalAttributes',
            ],
            config('dear-database.models.sale_fulfilment') => [
                'model' => config('dear-database.models.sale_fulfilment'),
                'table' => 'sale_fulfilments',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Fulfilments',
            ],
            config('dear-database.models.sale_invoice') => [
                'model' => config('dear-database.models.sale_invoice'),
                'table' => 'sale_invoices',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Invoices',
            ],
            config('dear-database.models.sale_credit_note') => [
                'model' => config('dear-database.models.sale_credit_note'),
                'table' => 'sale_credit_notes',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'CreditNotes',
            ],
            config('dear-database.models.attachment_line') => [
                'model' => config('dear-database.models.attachment_line'),
                'table' => 'attachment_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Attachments',
            ],
            config('dear-database.models.inventory_movement_line') => [
                'model' => config('dear-database.models.inventory_movement_line'),
                'table' => 'inventory_movement_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'InventoryMovements',
            ],
        ];
    }

    protected static function newFactory()
    {
        return SaleFactory::new();
    }

    public function saleCustomer(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.customer'), 'external_guid', 'customer_guid');
    }

    /**
     * Sale Billing Address
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.address'));
    }

    public function saleShippingAddress(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.sale_shipping_address'));
    }

    public function saleQuote(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.sale_quote'));
    }

    public function saleOrder(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.sale_order'));
    }

    public function saleManualJournal(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.sale_manual_journal'));
    }

    public function additionalAttribute(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.additional_attribute'));
    }

    public function saleFulfilments(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_fulfilment'));
    }

    public function saleInvoices(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_invoice'));
    }

    public function saleCreditNotes(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.sale_credit_note'));
    }

    public function attachmentLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.attachment_line'));
    }

    public function inventoryMovementLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.inventory_movement_line'));
    }
}
