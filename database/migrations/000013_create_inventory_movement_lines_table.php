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
        Schema::create('inventory_movement_lines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('external_guid');
            $table->uuid('product_guid');
            $table->dateTime('date');
            $table->decimal('cogs', 12, 4);
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
        Schema::dropIfExists('inventory_movement_lines');
    }
};
