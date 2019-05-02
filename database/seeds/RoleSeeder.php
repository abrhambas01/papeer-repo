<?php

use Illuminate\Database\Seeder;

use App\Role ;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::query()->delete();

        Role::truncate();
        

    	Role::firstOrCreate([
    		'title'   => 'Students',
    		'description' => 'Lorem ipsum dolor.'
    	]);


    	Role::firstOrCreate([
    		'title'   => 'Research Experts',
    		'description' =>'Research Experts from different parts of the world'
    	]);


    	Role::firstOrCreate([
    		'title'   => 'Professors',
    		'description' =>'Professors from different parts of the world'
    	]);

   
    }
}
