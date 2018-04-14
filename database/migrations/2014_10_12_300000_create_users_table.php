<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->primary('id');
            $table->string('id');
            $table->integer('nip');
            $table->string('name');
            $table->string('l_name')->nullable();
            $table->string('tb_name')->nullable();
            $table->string('ta_name')->nullable();
            $table->string('pob')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['l', 'p'])->nullable();
            $table->string('address')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('profile')->nullable();
            $table->enum('level', ['0', '1', '2'])->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
