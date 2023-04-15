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
        Schema::create('sale_invoice_sale_payment_line', function (Blueprint $table) {
            $table->uuid('sale_payment_line_id');
            $table->uuid('sale_invoice_id');
            $table->foreign('sale_payment_line_id')->references('id')->on('sale_payment_lines');
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
        Schema::dropIfExists('sale_invoice_sale_payment_line');
    }
};
