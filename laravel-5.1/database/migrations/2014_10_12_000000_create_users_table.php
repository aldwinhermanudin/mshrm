<?php

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
            $table->increments('id');
            $table->string('nip');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->boolean('superadmin')->default(0);
            $table->boolean('role_1')->default(0);
            $table->boolean('role_2')->default(0);
            $table->boolean('role_3')->default(0);
            $table->boolean('role_4')->default(0);
            $table->boolean('role_5')->default(0);
            $table->boolean('role_6')->default(0);
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
        Schema::drop('users');
    }
}
