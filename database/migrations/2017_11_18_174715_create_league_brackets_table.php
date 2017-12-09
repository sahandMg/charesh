<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueBracketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_brackets', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('columnNumber')->default(0);
            $table->string('row')->default(0);
            $table->string('teamName')->default(0);
            $table->string('point')->default(0);
            $table->string('type')->default('sg');
            $table->text('bracketTable')->nullable();
//            $table->text('RoundTable')->nullable();
            $table->text('LTable')->nullable();
            $table->string('column4')->nullable();
            $table->string('column5')->nullable();
            $table->string('column6')->nullable();
            $table->string('column7')->nullable();
            $table->string('column8')->nullable();
            $table->string('column9')->nullable();
            $table->string('column10')->nullable();
            $table->string('column11')->nullable();
            $table->string('column12')->nullable();
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
        Schema::dropIfExists('league_brackets');
    }
}
