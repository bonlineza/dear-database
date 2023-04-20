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
        Schema::create('sale_credit_note_sale_invoice_additional_charge', function (Blueprint $table) {
            $table->uuid('sale_invoice_additional_charge_id');
            $table->uuid('sale_credit_note_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_credit_note_sale_invoice_additional_charge');
    }
};
