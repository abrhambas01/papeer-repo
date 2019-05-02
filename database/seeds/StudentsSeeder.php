<?php

use Illuminate\Database\Seeder;
use App\Student ; 
class StudentsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // seed users who are students.. 

    $studentUsers = \App\User::students()->get();


    $studentLevel = ["college","hs","shs"] ; 
    

    $faker = \Faker\Factory::create();

    Student::truncate() ; 

    $studentUsers->each(function($item,$key) use ($faker, $studentLevel){
      // dump("key:".$key ."\nitem:" .$item.PHP_EOL);
      

      DB::table("students")->insert([ 
       'user_id' => $item->id ,   
       'student_school_id' => $faker->bankAccountNumber,    
       'level' => array_random($studentLevel), 
     ]);  

     // factory(App\Student::class)


    });

  }

}
