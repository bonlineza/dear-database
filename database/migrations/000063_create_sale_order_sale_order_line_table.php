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
        Schema::create('sale_order_sale_order_line', function (Blueprint $table) {
            $table->uuid('sale_order_line_id');
            $table->uuid('sale_order_id');
            $table->foreign('sale_order_line_id')->references('id')->on('sale_order_lines');
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
        Schema::dropIfExists('sale_order_sale_order_line');
    }
};
