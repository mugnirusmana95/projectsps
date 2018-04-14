<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termins', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('bpp')->nullable();
          $table->string('pengelolaan')->nullable();
          $table->date('date')->nullable();
          $table->date('date_end')->nullable();
          $table->string('id_scholarship');
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
        Schema::dropIfExists('termins');
    }
}
