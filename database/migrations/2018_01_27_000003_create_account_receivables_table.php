<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountReceivablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_receivables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice');
            $table->string('termin');
            $table->date('date')->nullable();
            $table->date('date_end')->nullable();
            $table->string('bpp')->nullable();
            $table->string('pengelolaan')->nullable();
            $table->string('tagihan')->nullable();
            $table->integer('id_scholarship');
            $table->integer('id_termin');
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
        Schema::dropIfExists('account_receivables');
    }
}
