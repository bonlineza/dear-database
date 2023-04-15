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
        Schema::create('sale_credit_notes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('external_guid')->nullable();
            $table->text('credit_note_invoice_number')->nullable();
            $table->text('memo')->nullable();
            $table->text('status');
            $table->dateTime('credit_note_date')->nullable();
            $table->text('credit_note_number')->nullable();
            $table->decimal('credit_note_conversion_rate', 12, 4)->nullable();
            $table->decimal('total_before_tax', 12, 4);
            $table->decimal('tax', 12, 4);
            $table->decimal('total', 12, 4);
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
        Schema::dropIfExists('sale_credit_notes');
    }
};
