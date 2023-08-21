<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\PurchaseFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Purchase extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    protected $dates = [
        'last_updated_date',
        'order_date',
    ];

    public static function getDearFieldTypes(): array
    {
        return [
            "OrderDate" => 'date',
            "LastUpdatedDate" => 'date',
        ];
    }

    public static function getDearMapping(): array
    {
        return [
            'ID' => 'external_guid',
            'SupplierID' => 'supplier_guid',
            'Supplier' => 'supplier',
            'Contact' => 'contact',
            'Phone' => 'phone',
            'InventoryAccount' => 'inventory_account',
            'BlindReceipt' => 'blind_receipt',
            'Approach' => 'approach',
            'BaseCurrency' => 'base_currency',
            'SupplierCurrency' => 'supplier_currency',
            'TaxRule' => 'tax_rule',
            'TaxCalculation' => 'tax_calculation',
            'Terms' => 'terms',
            'RequiredBy' => 'required_by',
            'Location' => 'location',
            'Note' => 'note',
            'OrderNumber' => 'order_number',
            'OrderDate' => 'order_date',
            'Status' => 'status',
            'RelatedDropShipSaleTask' => 'related_drop_ship_sale_task',
            'CurrencyRate' => 'currency_rate',
            'LastUpdatedDate' => 'last_updated_date',
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

            config('dear-database.models.purchase_shipping_address') => [
                'model' => config('dear-database.models.purchase_shipping_address'),
                'table' => 'purchase_shipping_addresses',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'ShippingAddress',
            ],
            config('dear-database.models.purchase_order') => [
                'model' => config('dear-database.models.purchase_order'),
                'table' => 'purchase_orders',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'Order',
            ],
            config('dear-database.models.purchase_stock') => [
                'model' => config('dear-database.models.purchase_stock'),
                'table' => 'purchase_stocks',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'StockReceived',
            ],
            config('dear-database.models.purchase_invoice') => [
                'model' => config('dear-database.models.purchase_invoice'),
                'table' => 'purchase_invoices',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'Invoice',
            ],
            config('dear-database.models.purchase_credit_note') => [
                'model' => config('dear-database.models.purchase_credit_note'),
                'table' => 'purchase_credit_notes',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'CreditNote',
            ],
            config('dear-database.models.purchase_manual_journal') => [
                'model' => config('dear-database.models.purchase_manual_journal'),
                'table' => 'purchase_manual_journals',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'ManualJournals',
            ],
            config('dear-database.models.additional_attribute') => [
                'model' => config('dear-database.models.additional_attribute'),
                'table' => 'additional_attributes',
                'relationship_type' => DearModel::$MANY_TO_ONE,
                'dear_key' => 'AdditionalAttributes',
            ],
            config('dear-database.models.attachment_line') => [
                'model' => config('dear-database.models.attachment_line'),
                'table' => 'attachment_lines',
                'relationship_type' => self::$MANY_TO_MANY,
                'dear_key' => 'Attachments',
            ],
            config('dear-database.models.inventory_movement_line') => [
                'model' => config('dear-database.models.inventory_movement_line'),
                'table' => 'inventory_movement_lines',
                'relationship_type' => self::$MANY_TO_MANY,
                'dear_key' => 'InventoryMovements',
            ],
        ];
    }

    protected static function newFactory()
    {
        return PurchaseFactory::new();
    }

    public function purchaseSupplier(): HasOne
    {
        return $this->hasOne(config('dear-database.models.supplier'), 'external_guid', 'supplier_guid');
    }

    /**
     * Purchase Billing Address
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.address'));
    }

    public function purchaseShippingAddress(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.purchase_shipping_address'));
    }

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.purchase_order'));
    }

    public function purchaseStock(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.purchase_stock'));
    }

    public function purchaseInvoice(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.purchase_invoice'));
    }

    public function purchaseCreditNote(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.purchase_credit_note'));
    }
    public function purchaseManualJournal(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.purchase_manual_journal'));
    }

    public function additionalAttribute(): BelongsTo
    {
        return $this->belongsTo(config('dear-database.models.additional_attribute'));
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
