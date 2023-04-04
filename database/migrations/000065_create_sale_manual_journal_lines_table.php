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
        Schema::create('sale_manual_journal_lines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('reference')->nullable();
            $table->decimal('amount', 12, 2)->nullable();
            $table->dateTime('date')->nullable();
            $table->text('debit')->nullable();
            $table->text('credit')->nullable();
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
        Schema::dropIfExists('sale_manual_journal_lines');
    }
};
