<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB ; 
use App\Paper ; 
use Illuminate\Filesystem\Filesystem ; 
use App\Photo ; 

class DatabaseController extends Controller
{
	public function removePhotosToPapers()
	{
		DB::table("photos")->truncate();
	}

	public function eraseFollowables()
	{
		DB::table("followables")->delete();
	}

	public function erasePapersAndPhotos()
	{
		Paper::truncate() ;

		Photo::where("imageable_type",'=','App\Paper')->delete();

		$file = new Filesystem;

		$targetDir = storage_path()."\app\public\papers" ;
		
		$erased = $file->cleanDirectory($targetDir);
		// $this->command->info('removed papers'); 

		dd("Erased Status:".$erased);

	}
	
}
