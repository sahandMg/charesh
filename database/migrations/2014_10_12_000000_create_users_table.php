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
            $table->string('fName');
            $table->string('lName');
            $table->string('username')->unique();
            $table->text('slug')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('credit')->default('0');
//            $table->integer('credit')->default('1000');
            $table->string('reset_password');
            $table->boolean('confirm')->default('0');
            $table->string('path');
            $table->integer('unread')->default(0);
//            $table->string('organize_id')->default('0');
//            mosabeqate sakhte shode
            $table->text('pageUrl')->nullable();
            //            mosabeqate shrkat karde
            $table->string('is_admin')->default('0');
            $table->string('role')->default('customer');
            $table->string('api_token', 60)->unique()->nullable();
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
