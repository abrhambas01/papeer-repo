<?php
use Illuminate\Database\Seeder;
use App\Paper ;
use App\User ;  	

class PapersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // working already.
    public function run()
    {
      $this->seedPapersToStudentsWhoHaventPublishedYet() ; 
      // $this->removePapersAndItsAttachments() ; 
    }


    public function removePapersAndItsAttachments()
    {
      Paper::truncate() ; 
      $file = new Filesystem;
      $targetDir = storage_path()."\app\public\papers" ;
      $erased = $file->cleanDirectory($targetDir);
      $this->command->info('removed papers'); 
      dd("Erased Status:".$erased);

        // removing from the like_paper.. 

    }


    protected function seedPapersToStudentsWhoHaventPublishedYet(){

      $users = User::students()->whereDoesntHave('papers')->pluck('id');
      
      dump($users);

      $users->each(function($item,$key){
        $seedPaper = factory(App\Paper::class,3)->create([
          'posted_by'  => $item,
        ]);

        $this->command->info($seedPaper);

      });


      // dd($users);
      // $this->seedPapersToStudents


    }


    public function seedPapers()
    { 
      // dd($users);
      // $this->seedPapersToStudents
      $storageDir = storage_path()."\app\public" ;
      $targetDir = public_path()."\storage";
      $students = User::where("role_id",1)->pluck('id')->toArray();
      
      $maxValue = 5 ; 


      $faker = \Faker\Factory::create();

      while ( $maxValue <=5 ) {
        $studentArray = array_random($students);

        factory(App\Paper::class)->create([
         'title'   => $faker->sentence(10, true), 
         'abstract'    => $faker->text(300),
         'posted_by'  => $studentArray,
         'attachment' => $faker->file($storageDir, $targetDir , false)
       ]);

        $maxValue++;
      }

    }


    public function seedSchoolsToPapers()
    {
     // get the school_id in the schools table

      $students = \App\School::pluck('id')->toArray();
  // store the value in an array


      $papersWithNoSchools = Paper::whereNull("school_id")->get();

      foreach ($papersWithNoSchools as $paper) {
        $studentArray = array_random($students);
        Paper::where('id','=',$paper->id)->update(['school_id'  =>  $studentArray]);
        $this->command->info('inserted to : '.$paper->id); 
      }

    }

  }
