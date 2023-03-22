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
        Schema::create('purchase_shipping_addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('display_address_line1')->nullable();
            $table->text('display_address_line2')->nullable();
            $table->text('line1')->nullable();
            $table->text('line2')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->text('postcode')->nullable();
            $table->text('country')->nullable();
            $table->text('company')->nullable();
            $table->boolean('ship_to_other')->nullable();
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
        Schema::dropIfExists('purchase_shipping_addresses');
    }
};
