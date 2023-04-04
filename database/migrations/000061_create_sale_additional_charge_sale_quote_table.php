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
        Schema::create('sale_additional_charge_sale_quote', function (Blueprint $table) {
            $table->uuid('sale_additional_charge_id');
            $table->uuid('sale_quote_id');
            $table->foreign('sale_additional_charge_id')->references('id')->on('sale_additional_charges');
            $table->foreign('sale_quote_id')->references('id')->on('sale_quotes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_additional_charge_sale_quote');
    }
};
