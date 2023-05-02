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
        Schema::create('product_movements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('external_guid')->nullable();
            $table->text('type')->nullable();
            $table->dateTime('date')->nullable();
            $table->text('number')->nullable();
            $table->integer('status')->nullable();
            $table->decimal('quantity')->nullable();
            $table->decimal('amount')->nullable();
            $table->text('location')->nullable();
            $table->decimal('batch_sn')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->text('from_to')->nullable();
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
        Schema::dropIfExists('product_movements');
    }
};
