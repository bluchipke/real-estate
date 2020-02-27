<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('property_id');
            $table->integer('landlord_id');
            $table->integer('property_type_id');
            $table->string('property_name', 120);
            $table->integer('units_count');
            $table->integer('no_floors')->nullable();
            $table->string('location_id', 120)->nullable();
            $table->integer('main_street')->nullable();
            $table->integer('estate_id')->nullable();
            $table->string('constituency', 120)->nullable();
            $table->string('county', 120)->nullable();
            $table->string('property_slug', 120)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('properties');
    }
}
