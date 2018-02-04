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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password', 60)->nullable();
<<<<<<< HEAD
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
=======
            $table->string('provider');
            $table->string('provider_id');
            $table->string('avatar')->nullable();
>>>>>>> 7afa17eedba0e2cc6346b45951a7ad53e5fc7680
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
