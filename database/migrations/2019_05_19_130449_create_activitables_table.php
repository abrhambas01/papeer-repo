<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->unsignedInteger('activity_id') ;
            $table->unsignedInteger('creator_id') ;
            $table->morphs('activitable') ;
            $table->timestamps();
        });

        Schema::create('activityables', function (Blueprint $table) {
            $table->unsignedInteger('activity_id') ;
            $table->unsignedInteger('creator_id') ;
            $table->morphs('activityable') ;
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
        Schema::dropIfExists('activities');
        Schema::dropIfExists('activityables');
    }
}
