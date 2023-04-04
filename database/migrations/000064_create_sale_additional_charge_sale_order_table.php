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
        Schema::create('sale_additional_charge_sale_order', function (Blueprint $table) {
            $table->uuid('sale_additional_charge_id');
            $table->uuid('sale_order_id');
            $table->foreign('sale_additional_charge_id')->references('id')->on('sale_additional_charges');
            $table->foreign('sale_order_id')->references('id')->on('sale_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_additional_charge_sale_order');
    }
};
