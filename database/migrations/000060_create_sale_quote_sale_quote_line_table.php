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
        Schema::create('sale_quote_sale_quote_line', function (Blueprint $table) {
            $table->uuid('sale_quote_line_id');
            $table->uuid('sale_quote_id');
            $table->foreign('sale_quote_line_id')->references('id')->on('sale_quote_lines');
            $table->foreign('sale_quote_id')->references('id')->on('sale_quotes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_quote_sale_quote_line');
    }
};
