<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterActivitiesTableRemovingOldPrimaryKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // used for recording the users activity in papers..
      Schema::create('paper_activity_types', function (Blueprint $table) {
              // $table->dropPrimary('paper_activity');    
          $table->increments('id');
          $table->string('activity_type',50); //recommendation // collaboration // Like // follow //publish paper

      });  
      
      /*THis will be not usable*/

      Schema::create('paper_activities', function (Blueprint $table) {
                  // $table->dropPrimary('paper_activity');    
            $table->increments('id');
            $table->unsignedInteger('paper_id');
            $table->unsignedInteger('creator_id');
            $table->unsignedInteger('activity_type_id');
            $table->string('display_name',100);
            $table->text('body')->nullable();
            $table->enum('status', ['0', '1'])->nullable();    
            $table->timestamps() ; 

            $table->foreign('paper_id')
            ->references('id')
            ->on('papers')
            ->onDelete('no action');

            $table->foreign('creator_id')
            ->references('id')
            ->on('users')
            ->onDelete('no action');

            $table->foreign('activity_type_id')
            ->references('id')
            ->on('paper_activity_types')
            ->onDelete('no action');

        
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('paper_activity_types');
      Schema::dropIfExists('paper_activities');
    }
  }
