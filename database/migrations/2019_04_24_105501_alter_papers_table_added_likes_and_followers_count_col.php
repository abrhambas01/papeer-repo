<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPapersTableAddedLikesAndFollowersCountCol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function (Blueprint $table) {
            $table->unsignedInteger('likeCount')->default('0')->after("attachment");
            $table->unsignedInteger('followersCount')->default('0')->after("likeCount");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('papers', function (Blueprint $table) {
           $table->dropColumn(['likeCount', 'followersCount']);
        });
    }
}
