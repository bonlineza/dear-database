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
        Schema::create('purchases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('external_guid');
            $table->uuid('supplier_guid');
            $table->text('supplier');
            $table->text('contact')->nullable();
            $table->text('phone')->nullable();
            $table->text('inventory_account');
            $table->boolean('blind_receipt');
            $table->text('approach');
            $table->text('base_currency');
            $table->text('supplier_currency');
            $table->text('tax_rule');
            $table->text('tax_calculation');
            $table->text('terms');
            $table->dateTime('required_by')->nullable();
            $table->text('location');
            $table->text('note')->nullable();
            $table->text('order_number');
            $table->dateTime('order_date');
            $table->text('status');
            $table->uuid('related_drop_ship_sale_task')->nullable();
            $table->decimal('currency_rate');
            $table->dateTime('last_updated_date');

            $table->uuid('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses');

            $table->uuid('purchase_shipping_address_id')->nullable();
            $table->foreign('purchase_shipping_address_id')->references('id')->on('purchase_shipping_addresses');

            $table->uuid('purchase_order_id')->nullable();
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');

            $table->uuid('purchase_stock_id')->nullable();
            $table->foreign('purchase_stock_id')->references('id')->on('purchase_stocks');

            $table->uuid('purchase_invoice_id')->nullable();
            $table->foreign('purchase_invoice_id')->references('id')->on('purchase_invoices');

            $table->uuid('purchase_credit_note_id')->nullable();
            $table->foreign('purchase_credit_note_id')->references('id')->on('purchase_credit_notes');

            $table->uuid('purchase_manual_journal_id')->nullable();
            $table->foreign('purchase_manual_journal_id')->references('id')->on('purchase_manual_journals');

            $table->uuid('additional_attribute_id')->nullable();
            $table->foreign('additional_attribute_id')->references('id')->on('additional_attributes');

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
        Schema::dropIfExists('purchases');
    }
};
