<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGametypesGamelocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_types', function (Blueprint $table) {
            $table->integer('user_id')->nullable(true)->unsigned()->after('id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('is_default')->default(false)->after('user_id');
        });

        Schema::table('game_locations', function (Blueprint $table) {
            $table->integer('user_id')->nullable(true)->unsigned()->after('id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('is_default')->default(false)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
