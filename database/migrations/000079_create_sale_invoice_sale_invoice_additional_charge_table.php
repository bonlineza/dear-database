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
        Schema::create('sale_invoice_sale_invoice_additional_charge', function (Blueprint $table) {
            $table->uuid('sale_invoice_additional_charge_id');
            $table->uuid('sale_invoice_id');
            $table->foreign('sale_invoice_additional_charge_id')->references('id')->on('sale_invoice_additional_charges');
            $table->foreign('sale_invoice_id')->references('id')->on('sale_invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_invoice_sale_invoice_additional_charge');
    }
};
