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
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('sale_order_number');
            $table->text('memo')->nullable();
            $table->text('status');
            $table->decimal('total_before_tax', 12, 4);
            $table->decimal('tax', 12, 4);
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
        Schema::dropIfExists('sale_orders');
    }
};
