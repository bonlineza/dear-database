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
        Schema::create('sale_fulfilment_ship_lines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('external_guid');
            $table->dateTime('shipment_date');
            $table->text('carrier');
            $table->text('boxes');
            $table->text('tracking_number');
            $table->text('tracking_url')->nullable();
            $table->boolean('is_shipped');
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
        Schema::dropIfExists('sale_fulfilment_ship_lines');
    }
};
