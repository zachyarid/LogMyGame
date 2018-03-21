<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentsToGamelocType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_types', function (Blueprint $table) {
            $table->text('comments')->nullable(true)->after('grade_premium');
        });

        Schema::table('game_locations', function (Blueprint $table) {
            $table->text('comments')->nullable(true)->after('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_types', function (Blueprint $table) {
            $table->dropColumn('comments');
        });

        Schema::table('game_locations', function (Blueprint $table) {
            $table->dropColumn('comments');
        });
    }
}
