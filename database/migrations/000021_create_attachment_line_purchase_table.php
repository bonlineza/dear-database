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
        Schema::create('attachment_line_purchase', function (Blueprint $table) {
            $table->uuid('attachment_line_id');
            $table->uuid('purchase_id');
            $table->foreign('attachment_line_id')->references('id')->on('attachment_lines');
            $table->foreign('purchase_id')->references('id')->on('purchases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachment_line_purchase');
    }
};
