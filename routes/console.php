<?php

use Illuminate\Foundation\Inspiring;

use App\User ;
use App\Console\Classes ; 


/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command("activities/student",function (){
	$this->info('Fetching activities for ..');

	$user = User::first()->pluck('id') ;
	
	dd($user);


})->describe('Fetching activities for a student..');



Artisan::command("activities/user",function (){
	$this->info('Fetching activities for ..');
	$user = User::first()->pluck('id') ;
	dd($user);
})->describe('Fetching activities for a user..');

Artisan::command("delete:papers --all",function (){
	$this->info('Deleting table values ..');



	
})->describe('Deleting {table} values ..');

