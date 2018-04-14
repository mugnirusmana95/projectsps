<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collegers', function (Blueprint $table) {
            $table->primary('nim');
            $table->string('nim');
            $table->string('name');
            $table->string('chapter')->nullable();
            $table->string('program')->nullable();
            $table->string('prodi')->nullable();
            $table->string('faculty')->nullable();
            $table->enum('status', ['0', '1'])->nullable();
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
        Schema::dropIfExists('collegers');
    }
}
