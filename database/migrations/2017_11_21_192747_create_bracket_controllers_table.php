<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBracketControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bracket_controllers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('elimination')->default(0);
            $table->integer('group')->default(0);
            $table->integer('league')->default(0);
            $table->integer('tournament_id')->default(0);
            $table->integer('organize_id')->default(0);
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
        Schema::dropIfExists('bracket_controllers');
    }
}
