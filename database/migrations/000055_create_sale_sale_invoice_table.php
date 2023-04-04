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
        Schema::create('sale_sale_invoice', function (Blueprint $table) {
            $table->uuid('sale_invoice_id');
            $table->uuid('sale_id');
            $table->foreign('sale_invoice_id')->references('id')->on('sale_invoices');
            $table->foreign('sale_id')->references('id')->on('sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_sale_invoice');
    }
};
