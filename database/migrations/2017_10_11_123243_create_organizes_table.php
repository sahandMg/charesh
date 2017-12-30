<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->nullable();
            $table->text('slug')->nullable();
            $table->integer('credit')->default(0);
            $table->integer('totalTickets')->default(0);
            $table->string('logo_path')->nullable();
            $table->string('background_path')->nullable();
            $table->mediumText('comment')->nullable();
            $table->integer('user_id')->default('0')->nullable();
            $table->integer('tournament_id')->default('0')->nullable();
            $table->longText('lat')->default('0');
            $table->longText('lng')->default('0');
            $table->integer('rating')->default('0');
            $table->string('email')->nullable();
            $table->string('telegram')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('organizes');
    }
}
