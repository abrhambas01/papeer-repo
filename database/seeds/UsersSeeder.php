<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon ;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	// we truncate the table ..
    	User::truncate();
        
        // we can change this
        $noOfStudents = 5 ; 
        $noOfUsers = 10 ; 

        $this->seedStudentsToTheUsersTable($noOfStudents);
        
    	$this->seedNonStudents($noOfUsers);


    }


    public function seedStudentsToTheUsersTable($noOfUsers){
        $faker = \Faker\Factory::create();

        for ($i=0; $i <= $noOfUsers ; $i++) { 
            factory(App\User::class)->create([
                'role_id' => 1, 
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => str_random(10),
                // 'confirmed_at ' => null
            ]);

        }    
    } 

    public function seedNonStudents($noOfUsers){
    	$faker = \Faker\Factory::create();

    	for ($i=0; $i <= $noOfUsers ; $i++) { 
    		factory(App\User::class)->create([
    			'role_id' => mt_rand(2,3), 
    			'name' => $faker->name,
    			'email' => $faker->unique()->safeEmail,
	        	'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
	        	'remember_token' => str_random(10),
	        	// 'confirmed_at ' => null
           ]);
        }    
    }



}



