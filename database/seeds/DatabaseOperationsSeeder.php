<?php

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use App\Paper ; 


class DatabaseOperationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// removing papers information seeder 
    	$this->removeEntriesFromPapers() ;
    }



    public function removeEntriesFromPapers()
    {
    	Paper::truncate() ; 
    	$file = new Filesystem;
    	$targetDir = storage_path()."\app\public\papers" ;
    	$erased = $file->cleanDirectory($targetDir);
    	$this->command->info('removed papers'); 
    	dd("Erased Status : ".$erased);

    }
}
