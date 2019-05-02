<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableAddedAccountTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   

        Schema::table("users", function (Blueprint $table) {
            $table->enum("account_type", ['0', '1'])->after("id")->default('0');    
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table("users", function (Blueprint $table) {
             $table->dropColumn("account_type");
         });
    }  
}
