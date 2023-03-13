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
            $table->string('external_guid');
            $table->string('supplier_guid');
            $table->string('supplier', 256);
            $table->string('contact')->nullable();
            $table->string('phone')->nullable();
            $table->string('inventory_account');
            $table->boolean('blind_receipt');
            $table->string('approach');
            $table->string('base_currency', 3);
            $table->string('supplier_currency', 3);
            $table->string('tax_rule');
            $table->string('tax_calculation');
            $table->string('terms');
            $table->dateTime('required_by')->nullable();
            $table->string('location');
            $table->string('note')->nullable();
            $table->string('order_number', 256);
            $table->dateTime('order_date');
            $table->string('status');
            $table->string('related_drop_ship_sale_task')->nullable();
            $table->string('currency_rate');
            $table->dateTime('last_updated_date');
            $table->dateTime('invoice_due_date')->nullable();

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
