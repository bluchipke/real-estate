<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilityBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utility_bills', function (Blueprint $table) {
            $table->bigIncrements('utility_bill_id');
            $table->integer('utility_id');
            $table->integer('all_property')->default('0');
            $table->integer('unit_id')->nullable(true);
            $table->integer('property_id')->nullable(true);
            $table->integer('utility_bill_amount');
            $table->integer('bill_recur')->nullable(true);
            $table->string('bill_recur_time', 50)->nullable(true);
            $table->integer('included_rent');
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
        Schema::dropIfExists('utility_bills');
    }
}
