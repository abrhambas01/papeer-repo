<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPapersTableAddedSchoolsCol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function (Blueprint $table) {
          $table->unsignedInteger('school_id')->after("id");

          $table->string('attachment_url',100)->after("attachment"); //recommendation // collaboration // Like // follow //publish paper

           $table->foreign('school_id')
           ->references('id')
           ->on('schools')
           ->onDelete('cascade');



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
           $table->dropForeign('papers_school_id_foreign');
           $table->dropColumn('school_id');
       });
    
    }
}
