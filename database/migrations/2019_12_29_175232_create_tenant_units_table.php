<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_units', function (Blueprint $table) {
            $table->bigIncrements('tenant_unit_id');
            $table->integer('tenant_id');
            $table->integer('property_id');
            $table->integer('unit_id');
            $table->date('occupation_date');
            $table->integer('deposit_amount');
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
        Schema::dropIfExists('tenant_units');
    }
}
