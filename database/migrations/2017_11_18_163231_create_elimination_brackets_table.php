<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEliminationBracketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elimination_brackets', function (Blueprint $table) {
            $table->increments('id');

            $table->text('ElBracketTableEdit')->nullable();
            $table->integer('tournament_id')->default(0);
            $table->string('type')->default('sg');
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
        Schema::dropIfExists('elimination_brackets');
    }
}
