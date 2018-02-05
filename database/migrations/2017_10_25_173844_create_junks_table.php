<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJunksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('junks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matchName')->nullable();
            $table->string('url')->nullable();
            $table->string('startTime')->nullable();
            $table->string('endTime')->nullable();
            $table->string('endTimeDays')->default('3600');
            $table->text('endRemain')->nullable();
            $table->mediumText('comment',1000)->nullable();
            $table->string('path')->nullable();
            $table->string('mode')->nullable();
            $table->string('matchType')->nullable();
            $table->integer('maxAttenders')->nullable();
            $table->integer('maxTeam')->nullable();
            $table->integer('subst')->nullable();
            $table->integer('maxMember')->nullable();
            $table->string('attendType')->nullable();
            $table->mediumText('prize',1000)->nullable();
            $table->mediumText('rules',1000)->nullable();
            $table->mediumText('plan',1000)->nullable();
            $table->integer('cost')->nullable();
            $table->string('city')->nullable();
            $table->mediumText('moreInfo',1200)->nullable();
            $table->text('address')->nullable();
            $table->text('lat')->nullable();
            $table->text('lng')->nullable();

            $table->integer('user_id')->default('0');
            $table->integer('organize_id')->default('0');
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
        Schema::dropIfExists('junks');
    }
}
