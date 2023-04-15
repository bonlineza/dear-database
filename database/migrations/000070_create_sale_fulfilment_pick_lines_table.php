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
        Schema::create('sale_fulfilment_pick_lines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_guid');
            $table->text('sku');
            $table->text('name');
            $table->text('location');
            $table->uuid('location_guid');
            $table->decimal('quantity', 12, 4);
            $table->text('batch_sn')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->text('box')->nullable();
            $table->boolean('non_inventory')->nullable();
            $table->dateTime('restock_date')->nullable();
            $table->uuid('restock_location_guid')->nullable();
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
        Schema::dropIfExists('sale_fulfilment_pick_lines');
    }
};
