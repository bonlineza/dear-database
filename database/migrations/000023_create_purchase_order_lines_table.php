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
        Schema::create('purchase_order_lines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_guid');
            $table->text('sku');
            $table->text('name');
            $table->decimal('quantity', 12, 4);
            $table->decimal('price', 12, 4);
            $table->decimal('discount', 12, 2);
            $table->decimal('tax', 12, 4);
            $table->text('tax_rule');
            $table->text('supplier_sku')->nullable();
            $table->text('comment')->nullable();
            $table->decimal('total', 12, 4);
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
        Schema::dropIfExists('purchase_order_lines');
    }
};
