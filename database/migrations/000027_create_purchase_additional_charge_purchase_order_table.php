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
        Schema::create('purchase_additional_charge_purchase_order', function (Blueprint $table) {
            $table->uuid('purchase_additional_charge_id');
            $table->uuid('purchase_order_id');
            $table->foreign('purchase_additional_charge_id')->references('id')->on('purchase_additional_charges');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_additional_charge_purchase_order');
    }
};
