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
        Schema::create('sales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('external_guid')->nullable();
            $table->text('customer')->nullable();
            $table->text('customer_guid')->nullable();
            $table->text('contact')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->text('default_account')->nullable();
            $table->boolean('skip_quote')->nullable();
            $table->text('shipping_notes')->nullable();
            $table->text('base_currency')->nullable();
            $table->text('customer_currency')->nullable();
            $table->text('tax_rule')->nullable();
            $table->text('tax_calculation')->nullable();
            $table->text('terms')->nullable();
            $table->text('price_tier')->nullable();
            $table->date('ship_by')->nullable();
            $table->text('location')->nullable();
            $table->date('sale_order_date')->nullable();
            $table->dateTime('last_modified_on')->nullable();
            $table->text('note')->nullable();
            $table->text('customer_reference')->nullable();
            $table->decimal('cogs_amount')->nullable();
            $table->text('status');
            $table->text('combined_picking_status')->nullable();
            $table->text('combined_packing_status')->nullable();
            $table->text('combined_shipping_status')->nullable();
            $table->text('fulfilment_status')->nullable();
            $table->text('combined_invoice_status')->nullable();
            $table->text('combined_payment_status')->nullable();
            $table->text('combined_tracking_numbers')->nullable();
            $table->text('carrier')->nullable();
            $table->decimal('currency_rate', 8, 5)->nullable();
            $table->text('sales_representative')->nullable();
            $table->text('type')->nullable();
            $table->text('source_channel')->nullable();
            $table->text('external_id')->nullable();
            $table->boolean('service_only')->nullable();
            $table->uuid('address_id')->nullable();
            $table->uuid('sale_shipping_address_id')->nullable();
            $table->integer('sale_quote_id')->nullable();
            $table->integer('sale_order_id')->nullable();
            $table->uuid('sale_manual_journal_id')->nullable();
            $table->uuid('additional_attribute_id')->nullable();
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
        Schema::dropIfExists('sales');
    }
};
