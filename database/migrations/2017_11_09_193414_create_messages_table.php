<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('message');
            $table->integer('user_id')->nullable();
            $table->integer('organize_id')->default(0);
            $table->integer('team_id')->default(0);
            $table->integer('tournament_id')->default(0);
            $table->string('sender')->nullable();
            $table->string('name')->nullable();
            $table->text('path')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
