<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountPayableDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_payable_details', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('chapter1', ['1', '2'])->nullable();
            $table->year('year1')->nullable();
            $table->enum('chapter2', ['1', '2'])->nullable();
            $table->year('year2')->nullable();
            $table->integer('total_sks')->nullable();
            $table->integer('total_chapter')->nullable();
            $table->string('pengelolaan')->nullable();
            $table->string('bpp')->nullable();
            $table->string('nim_colleger');
            $table->string('id_ap');
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
        Schema::dropIfExists('account_payable_details');
    }
}
