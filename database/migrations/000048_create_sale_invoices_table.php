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
        Schema::create('sale_invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('external_guid');
            $table->text('invoice_number')->nullable();
            $table->text('memo')->nullable();
            $table->text('status');
            $table->dateTime('invoice_date')->nullable();
            $table->dateTime('invoice_due_date')->nullable();
            $table->decimal('currency_conversion_rate', 12, 4);
            $table->text('billing_address_line_1')->nullable();
            $table->text('billing_address_line_2')->nullable();
            $table->text('link_fulfilment_number')->nullable();
            $table->decimal('total_before_tax', 12, 4);
            $table->decimal('tax', 12, 4);
            $table->decimal('total', 12, 4);
            $table->decimal('paid', 12, 4);
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
        Schema::dropIfExists('sale_invoices');
    }
};
