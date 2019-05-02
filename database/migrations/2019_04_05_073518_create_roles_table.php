<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title",20);
            $table->string("description");
        }); 

        Schema::table('users', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->after("id")->nullable();
            /*$table->foreign('role_id')
            ->references('id')->on('roles')
            ->onDelete('set null');*/
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('role_id');
        });    

    }
}
