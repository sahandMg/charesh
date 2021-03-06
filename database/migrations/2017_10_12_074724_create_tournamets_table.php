<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournametsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matchName');
            $table->text('slug')->nullable();
            $table->string('url')->nullable();
            $table->string('code');
            $table->string('startTime');
            $table->string('endTime');
            $table->string('endTimeDays')->default('3600');
            $table->text('endRemain');
            $table->mediumText('comment',1200);
            $table->string('path');
            $table->string('mode');
            $table->string('matchType');
            $table->integer('maxAttenders')->nullable();
            $table->integer('maxTeam')->nullable();
            $table->integer('subst')->nullable();
            $table->integer('maxMember')->nullable();
            $table->integer('tickets');
            $table->integer('sold')->default(0);
            $table->string('attendType');
            $table->mediumText('prize',1200);
            $table->mediumText('rules',1200);
//            $table->mediumText('plan',1200);
            $table->integer('cost');
            $table->string('city')->nullable();
            $table->mediumText('moreInfo',1200)->nullable();
            $table->text('free')->nullable();
            $table->text('address',900)->nullable();
            $table->string('lng',255)->default('51.38');
            $table->string('lat',255)->default('35.69');
            $table->integer('coordinate')->nullable();

            $table->integer('canceled')->default('0');
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
        Schema::dropIfExists('tournaments');
    }
}
