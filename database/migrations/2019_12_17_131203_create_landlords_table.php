<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandlordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landlords', function (Blueprint $table) {
            $table->bigIncrements('landlord_id');
            $table->string('first_name', 120);
            $table->string('last_name', 120);
            $table->string('postal_address', 120)->nullable();
            $table->string('postal_code', 120)->nullable();
            $table->string('phone_number', 120)->nullable();
            $table->string('email_address', 120)->nullable();
            $table->string('billing_type', 120)->nullable();
            $table->integer('percentage')->nullable();
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
        Schema::dropIfExists('landlords');
    }
}
