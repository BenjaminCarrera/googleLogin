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
            $table->string('family_name');
            $table->string('picture');
            $table->string('locale');
            $table->string('email')->unique();
            $table->string('given_name');
            $table->string('hd');
            $table->boolean('verified_email');
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('google_id')->nullable();
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
