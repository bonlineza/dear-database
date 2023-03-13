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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('external_guid');
            $table->string('name');
            $table->string('currency');
            $table->string('payment_term');
            $table->string('account_payable');
            $table->string('tax_rule');
            $table->string('status');
            $table->integer('discount');
            $table->string('comments', 10000)->nullable();
            $table->string('attribute_set')->nullable();
            $table->string('additional_attribute_1')->nullable();
            $table->string('additional_attribute_2')->nullable();
            $table->string('additional_attribute_3')->nullable();
            $table->string('additional_attribute_4')->nullable();
            $table->string('additional_attribute_5')->nullable();
            $table->string('additional_attribute_6')->nullable();
            $table->string('additional_attribute_7')->nullable();
            $table->string('additional_attribute_8')->nullable();
            $table->string('additional_attribute_9')->nullable();
            $table->string('additional_attribute_10')->nullable();
            $table->string('last_modified_on');

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
        Schema::dropIfExists('suppliers');
    }
};
