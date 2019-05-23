<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

class TestingCollection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collect:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Testing queries for the app. returns collections..";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // you can put your methods here..
        // $this->collect->returnsActivitiesForAStudent();
        $this->testFlatMap();
    }


    /*testing flat map here..*/
    public function testFlatMap()
    {
         $collection = \App\Paper::where("posted_by",'=',2)->has('activityCreators')
         ->with(['activityCreators','activityTypes'])
         ->get() ; 

         print "Activity Type :" .dump($collection->flatMap->activityTypes->toArray())  ;

         print "Creator :" .dump($collection->flatMap->activityCreators->toArray())  ;

/*        
        dump($collection);

        $flattened = $collection->flatMap(function($data){
            return array_map();
        });  


        dd($flattened->toArray());
*/
    }






}
