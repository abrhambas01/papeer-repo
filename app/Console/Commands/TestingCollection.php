<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Console\Classes\TestCollection ; 

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
    public function __construct(TestCollection $testcollect)
    {
        parent::__construct();
        $this->collect = $testcollect ; 
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // you can put your methods here..
        $this->collect->returnsActivitiesForAStudent();
    }




    


}
