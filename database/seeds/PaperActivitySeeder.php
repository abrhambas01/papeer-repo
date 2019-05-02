<?php

use Illuminate\Database\Seeder;
use App\PaperActivityType;

class PaperActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // add the publishing or the likes of the paper.. 
        $this->updateActivitiesForStudents();
        $this->updateActivitiesForNonStudents();

    // seed more extra activities..

        $this->seedStudentsActivity();
        $this->seedNonStudentsActivity();


    }

    /*seeding more activities to the paper_activities table..*/
    public function updateActivitiesForNonStudents()
    {
    // getting non student users
        $nonStudentUsers = \App\User::nonStudents()->pluck('id');


        // get all the papers.
        $paperId = \App\Paper::pluck('id');
        
        dump("Paper ID: ".$paperId);

        // we'll get every activity id except 5 because 5 is publishing of a paper...
        $activityIds  = DB::table('paper_activity_types')
        ->where('id','<>',5)
        ->pluck('id');

        dump("activity id: ".$activityIds);

        $creatorId = $nonStudentUsers->random() ; 
        

        dump("Creator Id :".$creatorId);


           // for each non students.
        $nonStudentUsers->each(function($item,$key){
            dump($item ." " .$key);
            // we create a paper for each of this user. up to 3 only..

            factory(App\Paper::class,3)->create([
                'title' => $faker->text(15), 
                'research_description' => $faker->sentence(8, $variableNbWords),
                'abstract' => $faker->realText(150,true),
                'school_id' => $schoolArray , 
                'posted_by'  => $studentArray,
                'attachment_url' => $faker->url , 
                 // $users = request()->file('attachment')->store('papers', 'public')
                'attachment' => $fileName
            ]);


            /*factory(PaperActivity::class,20)->create()->each(function ($u) use ($post){ 
                $post->comments()->save(factory(Comment::class)->make([
                    'user_id'   =>  $u->id 
                ])); 
            }); 
*/




        });
        


        // factory(App\PaperActivity::class)->create([
        //     'user_id' => $creatorId
        // ]);


        // dd($nonStudentsUsers);

    }

    /*
    so an activity 4 students will only happen if he published a paper/liked a paper..
     */
    public function updateActivitiesForStudents()
    {
             $nonStudentUsers = \App\User::students()->pluck('id');

                // get all the id of the one's who published a paper
             $papers = \App\Paper::select('posted_by','id')->get();

                    dump("Users who posted".$papers);

                     $papers->each(function($i,$key){
                        dump($i);
                    });

    }

}
