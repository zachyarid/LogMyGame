<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')->on('users');
            $table->date('date');
            $table->time('time');
            $table->integer('location_id')->unsigned();
            //$table->foreign('location_id')->references('id')->on('game_locations');
            $table->integer('age_id')->unsigned();
            //$table->foreign('age_id')->references('id')->on('ages');
            $table->string('home_team');
            $table->integer('home_team_score');
            $table->string('away_team');
            $table->integer('away_team_score');
            $table->string('center_name');
            $table->string('ar1_name')->nullable(true);
            $table->string('ar2_name')->nullable(true);
            $table->string('th_name')->nullable(true);
            $table->text('comments')->nullable(true);
            $table->string('ussf_grade')->comment('To be able to have a history outlook on games refereed.');
            $table->decimal('game_fee', '5', '2');
            $table->decimal('miles_run', '4', '2')->nullable(true);
            $table->integer('type');
            $table->string('platform');
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
        Schema::dropIfExists('games');
    }
}
