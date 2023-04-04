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
        Schema::create('inventory_movement_line_sale', function (Blueprint $table) {
            $table->uuid('inventory_movement_line_id');
            $table->uuid('sale_id');
            $table->foreign('inventory_movement_line_id')->references('id')->on('inventory_movement_lines');
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
        Schema::dropIfExists('inventory_movement_line_sale');
    }
};
