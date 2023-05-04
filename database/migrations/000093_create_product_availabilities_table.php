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
        Schema::create('product_availabilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_guid');
            $table->string('sku');
            $table->string('name');
            $table->string('barcode')->nullable();
            $table->string('location');
            $table->string('bin')->nullable();
            $table->string('batch')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->decimal('on_hand', 12, 4);
            $table->decimal('allocated', 12, 4);
            $table->decimal('available', 12, 4);
            $table->decimal('on_order', 12, 4);
            $table->decimal('stock_on_hand', 12, 4);
            $table->decimal('in_transit', 12, 4);
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
        Schema::dropIfExists('product_availabilities');
    }
};
