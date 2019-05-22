<?php
use Illuminate\Database\Seeder;
use App\Paper ;
use App\User ;  	
use App\Photo ; 
use Illuminate\Filesystem\Filesystem ; 
use Illuminate\Support\Facades\Storage;


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
      // testing out polymorphic relationships (1 - 1 / 1 -many ) ..
      // $this->seedPhotosToPapers();
      $this->seedPapersToStudentsWhoHaventPublishedYet() ; 
      
      // $this->removePapersAndItsAttachments() ; 
    }


    public function erasePhotosToPapers($value='')
    {
  # code...
    }


    public function erasePhotosToUsers($value='')
    {



    }


    public function seedPapersAndPhotos($value='')
    {
      // factory(App\Paper::class)
    }

    public function seedPhotosToPapers()
    {
      // getting the pictures (the sample pictures).
      $photosDir = storage_path()."\app\public\attachments\photos\papers";

      // storing the pictures to 
      $targetDir = storage_path()."\app\public\papers\photos" ;
      $faker = \Faker\Factory::create();
      // papers that doesn't have photos -> retrieve the id 
      $papers = Paper::doesntHave('photos')->pluck('id');

      $papers->dd();

      // for each of the papers-> pass the id..
      $papers->each(function ($item,$key) use ($faker, $photosDir, $targetDir) {
        $photoFactory = factory(App\Photo::class, 2)->create([
          'image_file' => $faker->file($photosDir, $targetDir , false), 
          'imageable_id' => $item,
          'imageable_type' => 'App\Paper',
        ]); 
      });  

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

      DB::table("papers")->truncate();

      $usersWithNoPapers = User::students()->whereDoesntHave('papers')->pluck('id');
      
      // dump($users);

        // getting the pictures (the sample pictures..).
      $photosDir = storage_path()."\app\public\attachments\photos\papers";

      // storing the pictures to 
      $targetDir = storage_path()."\app\public\papers\photos" ;
      
      $faker = \Faker\Factory::create();
  // for each of this users..
      $usersWithNoPapers->each(function($item,$key) use ($photosDir, $faker, $targetDir){
        // seed 3 papers to each of them.
        $seedPaper = factory(App\Paper::class,3)->create([
          'posted_by'  => $item,
        ])->each(function($ppr , $key) use ($item, $photosDir, $faker, $targetDir){
            //for each create 2 entries of photos
              $attachmentLocation = $faker->file($photosDir, $targetDir , true);    
              $fileInfo = pathinfo($attachmentLocation);
              dump($fileInfo);
                // Storage::makeDirectory($fileInfo);
               // getting only the file name w/out the directory name..
              $fileName = $fileInfo['basename'];
              
              dump($fileName);

              Photo::create([
                'image_file' =>  $fileName, // the file name only..
                'imageable_id' => $item,
                'imageable_type' => 'App\Paper',
              ]);

              $this->command->info("seeded");

        });

      });


      // dd($users);
      // $this->seedPapersToStudents


    }

    protected function storagePath(){
      return storage_path()."\app\public" ;
    }

    public function seedPapers()
    { 
          // dd($users);
            // $this->seedPapersToStudents
      $storageDir = $this->storagePath() ; 
      $targetDir = public_path()."\storage";
      $students = User::where("role_id",1)->pluck('id')->toArray();
      $maxValue = 5 ; 

      $faker = \Faker\Factory::create();

      while ( $maxValue <= 5 ) {
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
