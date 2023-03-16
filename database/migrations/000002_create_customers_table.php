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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('external_guid');
            $table->text('name');
            $table->text('status');
            $table->text('currency');
            $table->text('payment_term');
            $table->text('account_receivable');
            $table->text('revenue_account');
            $table->text('tax_rule');
            $table->text('price_tier');
            $table->text('carrier')->nullable();
            $table->text('sales_representative')->nullable();
            $table->text('location')->nullable();
            $table->integer('discount');
            $table->text('comments')->nullable();
            $table->integer('credit_limit');
            $table->text('tags')->nullable();
            $table->text('attribute_set')->nullable();
            $table->text('additional_attribute_1')->nullable();
            $table->text('additional_attribute_2')->nullable();
            $table->text('additional_attribute_3')->nullable();
            $table->text('additional_attribute_4')->nullable();
            $table->text('additional_attribute_5')->nullable();
            $table->text('additional_attribute_6')->nullable();
            $table->text('additional_attribute_7')->nullable();
            $table->text('additional_attribute_8')->nullable();
            $table->text('additional_attribute_9')->nullable();
            $table->text('additional_attribute_10')->nullable();
            $table->text('last_modified_on');

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
        Schema::dropIfExists('customers');
    }
};
