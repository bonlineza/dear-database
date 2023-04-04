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
        Schema::create('sale_manual_journal_sale_manual_journal_line', function (Blueprint $table) {
            $table->uuid('sale_manual_journal_line_id');
            $table->uuid('sale_manual_journal_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_manual_journal_sale_manual_journal_line');
    }
};
