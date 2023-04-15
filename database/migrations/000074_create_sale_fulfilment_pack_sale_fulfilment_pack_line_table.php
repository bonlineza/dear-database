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
        Schema::create('sale_fulfilment_pack_sale_fulfilment_pack_line', function (Blueprint $table) {
            $table->uuid('sale_fulfilment_pack_line_id');
            $table->uuid('sale_fulfilment_pack_id');
            $table->foreign('sale_fulfilment_pack_line_id')->references('id')->on('sale_fulfilment_pack_lines');
            $table->foreign('sale_fulfilment_pack_id')->references('id')->on('sale_fulfilment_packs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_fulfilment_pack_sale_fulfilment_pack_line');
    }
};
