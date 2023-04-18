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
        Schema::create('sale_fulfilments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('external_guid');
            $table->integer('sale_fulfilment_number');
            $table->text('linked_invoice_number')->nullable();
            $table->text('fulfilment_status');
            $table->uuid('sale_fulfilment_pick_id')->nullable();
            $table->foreign('sale_fulfilment_pick_id')->references('sale_fulfilment_picks')->on('id');

            $table->uuid('sale_fulfilment_pack_id')->nullable();
            $table->foreign('sale_fulfilment_pack_id')->references('sale_fulfilment_packs')->on('id');

            $table->uuid('sale_fulfilment_ship_id')->nullable();
            $table->foreign('sale_fulfilment_ship_id')->references('sale_fulfilment_ships')->on('id');

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
        Schema::dropIfExists('sale_fulfilments');
    }
};
