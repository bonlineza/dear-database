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
        Schema::create('sale_fulfilment_ships', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('status');
            $table->date('require_by')->nullable();
            $table->text('shipping_notes')->nullable();
            $table->uuid('sale_shipping_address_id')->nullable();
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
        Schema::dropIfExists('sale_fulfilment_ships');
    }
};
