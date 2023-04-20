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
        Schema::create('sale_invoice_additional_charges', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 4)->nullable();
            $table->decimal('quantity', 12, 4)->nullable();
            $table->decimal('discount', 12, 2)->nullable();
            $table->decimal('tax', 12, 4)->nullable();
            $table->decimal('total', 12, 4)->nullable();
            $table->text('account')->nullable();
            $table->text('tax_rule')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('sale_invoice_additional_charges');
    }
};
