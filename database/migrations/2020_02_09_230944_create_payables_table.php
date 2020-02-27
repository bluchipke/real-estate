<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payables', function (Blueprint $table) {
            $table->bigIncrements('payable_id');
            $table->integer('bill_id');
            $table->integer('provider_id');
            $table->integer('amount_paid');
            $table->string('reference', 120)->nullable(true);
            $table->date('trans_date');
            $table->string('payment_mode')->nullable(true);
            $table->string('paid_by', 120)->nullable(true);
            $table->text('payment_notes')->nullable(true);
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
        Schema::dropIfExists('payables');
    }
}
