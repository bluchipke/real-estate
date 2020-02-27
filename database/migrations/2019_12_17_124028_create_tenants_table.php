<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('tenant_id');
            $table->string('first_name', 120);
            $table->string('last_name', 120);
            $table->string('tenant_email', 120)->nullable();
            $table->string('phone_number', 120);
            $table->string('id_card_passport', 120);
            $table->string('tenant_code', 120)->nullable();
            $table->string('nssf_number', 120)->nullable();
            $table->string('nhif_number', 120)->nullable();
            $table->string('kra_pin', 120)->nullable();
            $table->string('gender', 50);
            $table->string('marital_status', 150)->nullable();
            $table->date('dob')->nullable();
            $table->string('postal_address', 120)->nullable();
            $table->string('postal_code', 120)->nullable();
            $table->date('begin_date');
            $table->integer('property_id');
            $table->integer('unit_id');
            $table->string('employer_name')->nullable();
            $table->text('employer_contact')->nullable();
            $table->string('job_title', 120)->nullable();
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
        Schema::dropIfExists('tenants');
    }
}
