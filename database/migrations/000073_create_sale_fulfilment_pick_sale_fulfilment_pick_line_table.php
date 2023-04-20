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
        Schema::create('sale_fulfilment_pick_sale_fulfilment_pick_line', function (Blueprint $table) {
            $table->uuid('sale_fulfilment_pick_line_id');
            $table->uuid('sale_fulfilment_pick_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_fulfilment_pick_sale_fulfilment_pick_line');
    }
};
