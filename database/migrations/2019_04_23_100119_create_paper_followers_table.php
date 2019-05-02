<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaperFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follower_paper', function (Blueprint $table) {
            $table->unsignedInteger('paper_id');

            $table->unsignedInteger('user_id');
            
            $table->primary(['paper_id', 'user_id']);   

// using foreign keys
           /* $table->foreign('paper_id')
            ->references('id')
            ->on('papers')
            ->onDelete('cascade');
         
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');*/

            
            $table->timestamp('followed_on');

        });  


        Schema::create('like_paper', function (Blueprint $table) {
            $table->unsignedInteger('paper_id');
            $table->unsignedInteger('user_id');
            $table->primary(['paper_id', 'user_id']);   
/*
            $table->foreign('paper_id')
            ->references('id')
            ->on('papers')
            ->onDelete('restrict');
         
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('restrict');*/

            $table->timestamp('liked_on');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follower_paper');
        Schema::dropIfExists('like_paper');
    }


}
