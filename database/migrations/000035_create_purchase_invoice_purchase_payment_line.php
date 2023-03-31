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
        Schema::create('purchase_invoice_purchase_payment_line', function (Blueprint $table) {
            $table->uuid('purchase_payment_line_id');
            $table->uuid('purchase_invoice_id');
            $table->foreign('purchase_payment_line_id')->references('id')->on('purchase_payment_lines');
            $table->foreign('purchase_invoice_id')->references('id')->on('purchase_invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_invoice_purchase_payment_line');
    }
};
