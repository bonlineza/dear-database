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
        Schema::create('purchase_credit_notes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('credit_note_number')->nullable();
            $table->dateTime('credit_note_date')->nullable();
            $table->text('status');
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
        Schema::dropIfExists('purchase_credit_notes');
    }
};
