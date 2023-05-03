<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_guid');
            $table->text('sku')->unique();
            $table->text('name');
            $table->text('category');
            $table->text('brand')->nullable();
            $table->text('type');
            $table->text('costing_method');
            $table->text('drop_ship_mode');
            $table->text('default_location')->nullable();
            $table->decimal('length')->default(0);
            $table->decimal('width')->default(0);
            $table->decimal('height')->default(0);
            $table->decimal('weight')->default(0);
            $table->decimal('carton_length')->default(0)->nullable();
            $table->decimal('carton_width')->default(0)->nullable();
            $table->decimal('carton_height')->default(0)->nullable();
            $table->decimal('carton_quantity')->default(0)->nullable();
            $table->decimal('carton_inner_quantity')->default(0)->nullable();
            $table->text('uom');
            $table->text('weight_units')->nullable();
            $table->text('dimensions_units')->nullable();
            $table->text('barcode')->nullable();
            $table->decimal('minimum_before_reorder')->default(0);
            $table->decimal('reorder_quantity')->default(0);
            $table->decimal('price_tier_1', 12, 4);
            $table->decimal('price_tier_2', 12, 4);
            $table->decimal('price_tier_3', 12, 4);
            $table->decimal('price_tier_4', 12, 4);
            $table->decimal('price_tier_5', 12, 4);
            $table->decimal('price_tier_6', 12, 4);
            $table->decimal('price_tier_7', 12, 4);
            $table->decimal('price_tier_8', 12, 4);
            $table->decimal('price_tier_9', 12, 4);
            $table->decimal('price_tier_10', 12, 4);
            $table->decimal('average_cost', 12, 4);
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('internal_note')->nullable();
            $table->text('additional_attribute_1')->nullable();
            $table->text('additional_attribute_2')->nullable();
            $table->text('additional_attribute_3')->nullable();
            $table->text('additional_attribute_4')->nullable();
            $table->text('additional_attribute_5')->nullable();
            $table->text('additional_attribute_6')->nullable();
            $table->text('additional_attribute_7')->nullable();
            $table->text('additional_attribute_8')->nullable();
            $table->text('additional_attribute_9')->nullable();
            $table->text('additional_attribute_10')->nullable();
            $table->text('attribute_set')->nullable();
            $table->text('discount_rule')->nullable();
            $table->text('tags')->nullable();
            $table->text('status');
            $table->text('stock_locator')->nullable();
            $table->text('cogs_account')->nullable();
            $table->text('revenue_account')->nullable();
            $table->text('expense_account')->nullable();
            $table->text('inventory_account')->nullable();
            $table->text('purchase_tax_rule')->nullable();
            $table->text('sale_tax_rule')->nullable();
            $table->dateTime('last_modified_on')->nullable();
            $table->boolean('sellable');
            $table->text('pick_zones')->nullable();
            $table->boolean('bill_of_material');
            $table->boolean('auto_assembly');
            $table->boolean('auto_disassembly');
            $table->decimal('quantity_to_produce');
            $table->text('assembly_instruction_url')->nullable();
            $table->text('assembly_cost_estimation_method')->nullable();
            $table->text('bom_type')->nullable();
            $table->text('hs_code')->nullable();
            $table->text('country_of_origin')->nullable();
            $table->text('country_of_origin_code')->nullable();
            $table->uuid('price_tier_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
