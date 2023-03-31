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
        Schema::create('purchase_credit_note_purchase_invoice_additional_charge', function (Blueprint $table) {
            $table->uuid('purchase_invoice_additional_charge_id');
            $table->uuid('purchase_credit_note_id');
            $table->foreign('purchase_invoice_additional_charge_id')->references('id')->on('purchase_invoice_additional_charges');
            $table->foreign('purchase_credit_note_id')->references('id')->on('purchase_credit_notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_credit_note_purchase_invoice_additional_charge');
    }
};
