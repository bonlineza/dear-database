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
        Schema::create('locations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('external_guid');
            $table->string('name');
            $table->boolean('is_default')->nullable();
            $table->boolean('deprecated')->nullable();
            $table->boolean('fixed_assets_location')->nullable();
            $table->uuid('parent_guid')->nullable();
            $table->integer('reference_count')->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('address_city_suburb')->nullable();
            $table->string('address_state_province')->nullable();
            $table->string('address_zip_post_code')->nullable();
            $table->string('address_country')->nullable();
            $table->string('pick_zones')->nullable();
            $table->boolean('is_shop_floor');
            $table->boolean('is_co_man');
            $table->boolean('is_staging');
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
        Schema::dropIfExists('locations');
    }
};
