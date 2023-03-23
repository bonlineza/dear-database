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
        Schema::create('purchase_stock_lines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->dateTime('date');
            $table->decimal('quantity', 12, 4);
            $table->uuid('product_guid');
            $table->text('sku');
            $table->text('name');
            $table->text('location');
            $table->uuid('location_guid');
            $table->boolean('received');
            $table->text('batchsn')->nullable();
            $table->text('supplier_sku')->nullable();
            $table->dateTime('expiry_date')->nullable();
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
        Schema::dropIfExists('purchase_stock_lines');
    }
};
