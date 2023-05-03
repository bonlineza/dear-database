<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    protected $dates = [
        'last_modified_on',
    ];

    public static function getDearFieldTypes(): array
    {
        return [
            "LastModifiedOn" => 'date',
        ];
    }

    public static function getDearMapping(): array
    {
        return [
            "ID" => "product_guid",
            "SKU" => "sku",
            "Name" => "name",
            "Category" => "category",
            "Brand" => "brand",
            "Type" => "type",
            "CostingMethod" => "costing_method",
            "DropShipMode" => "drop_ship_mode",
            "DefaultLocation" => "default_location",
            "Length" => "length",
            "Width" => "width",
            "Height" => "height",
            "Weight" => "weight",
            "CartonLength" => "carton_length",
            "CartonWidth" => "carton_width",
            "CartonHeight" => "carton_height",
            "CartonQuantity" => "carton_quantity",
            "CartonInnerQuantity" => "carton_inner_quantity",
            "UOM" => "uom",
            "WeightUnits" => "weight_units",
            "DimensionsUnits" => "dimensions_units",
            "Barcode" => "barcode",
            "MinimumBeforeReorder" => "minimum_before_reorder",
            "ReorderQuantity" => "reorder_quantity",
            "PriceTier1" => "price_tier_1",
            "PriceTier2" => "price_tier_2",
            "PriceTier3" => "price_tier_3",
            "PriceTier4" => "price_tier_4",
            "PriceTier5" => "price_tier_5",
            "PriceTier6" => "price_tier_6",
            "PriceTier7" => "price_tier_7",
            "PriceTier8" => "price_tier_8",
            "PriceTier9" => "price_tier_9",
            "PriceTier10" => "price_tier_10",
            "AverageCost" => "average_cost",
            "ShortDescription" => "short_description",
            "Description" => "description",
            "InternalNote" => "internal_note",
            "AdditionalAttribute1" => "additional_attribute_1",
            "AdditionalAttribute2" => "additional_attribute_2",
            "AdditionalAttribute3" => "additional_attribute_3",
            "AdditionalAttribute4" => "additional_attribute_4",
            "AdditionalAttribute5" => "additional_attribute_5",
            "AdditionalAttribute6" => "additional_attribute_6",
            "AdditionalAttribute7" => "additional_attribute_7",
            "AdditionalAttribute8" => "additional_attribute_8",
            "AdditionalAttribute9" => "additional_attribute_9",
            "AdditionalAttribute10" => "additional_attribute_10",
            "AttributeSet" => "attribute_set",
            "DiscountRule" => "discount_rule",
            "Tags" => "tags",
            "Status" => "status",
            "StockLocator" => "stock_locator",
            "COGSAccount" => "cogs_account",
            "RevenueAccount" => "revenue_account",
            "ExpenseAccount" => "expense_account",
            "InventoryAccount" => "inventory_account",
            "PurchaseTaxRule" => "purchase_tax_rule",
            "SaleTaxRule" => "sale_tax_rule",
            "LastModifiedOn" => "last_modified_on",
            "Sellable" => "sellable",
            "PickZones" => "pick_zones",
            "BillOfMaterial" => "bill_of_material",
            "AutoAssembly" => "auto_assembly",
            "AutoDisassembly" => "auto_disassembly",
            "QuantityToProduce" => "quantity_to_produce",
            "AssemblyInstructionURL" => "assembly_instruction_url",
            "AssemblyCostEstimationMethod" => "assembly_cost_estimation_method",
            "BOMType" => "bom_type",
            "HSCode" => "hs_code",
            "CountryOfOrigin" => "country_of_origin",
            "CountryOfOriginCode" => "country_of_origin_code",
        ];
    }

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.product_movement') => [
                'model' => config('dear-database.models.product_movement'),
                'table' => 'product_movements',
                'relationship_type' => self::$MANY_TO_MANY,
                'dear_key' => 'Movements',
            ],
            config('dear-database.models.attachment_line') => [
                'model' => config('dear-database.models.attachment_line'),
                'table' => 'attachment_lines',
                'relationship_type' => self::$MANY_TO_MANY,
                'dear_key' => 'Attachments',
            ],
        ];
    }

    public function productMovements(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.product_movement'));
    }

    public function attachmentLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.attachment_line'));
    }
}
