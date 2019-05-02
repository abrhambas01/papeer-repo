<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPapersTableAddedPostedByCol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function (Blueprint $table) {
            $table->unsignedInteger("posted_by")->after("id");

            $table->foreign('posted_by')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            
            $table->string("research_description",100)->after("title");
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
            $table->dropForeign("posted_by");
        });
    }
}
