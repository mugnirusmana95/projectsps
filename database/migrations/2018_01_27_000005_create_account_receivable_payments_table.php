<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountReceivablePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_receivable_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_payment');
            $table->string('sp2d')->nullable();
            $table->date('date')->nullable();
            $table->string('bpp')->nullable();
            $table->string('pengelolaan')->nullable();
            $table->integer('id_ar');
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
        Schema::dropIfExists('account_receivable_payments');
    }
}
