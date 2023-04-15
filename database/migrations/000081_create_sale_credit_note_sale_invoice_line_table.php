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
        Schema::create('sale_credit_note_sale_invoice_line', function (Blueprint $table) {
            $table->uuid('sale_invoice_line_id');
            $table->uuid('sale_credit_note_id');
            $table->foreign('sale_invoice_line_id')->references('id')->on('sale_invoice_lines');
            $table->foreign('sale_credit_note_id')->references('id')->on('sale_credit_notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_credit_note_sale_invoice_line');
    }
};
