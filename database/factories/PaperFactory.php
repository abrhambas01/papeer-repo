<?php

use Faker\Generator as Faker;

$factory->define(App\Paper::class, function (Faker $faker) {
	$storageDir = storage_path()."\app\public\attachments" ;
	$targetDir = storage_path()."\app\public\papers" ;
	$students = \App\User::students()->pluck('id')->toArray();
	$schools = \App\School::pluck('id')->toArray();
	$schoolArray = array_random($schools);
	$studentArray = array_random($students);

	$attachmentLocation = $faker->file($storageDir, $targetDir , true); 
	
	$fileInfo = pathinfo($attachmentLocation);
	
	$fileName = $fileInfo['basename'];

	$variableNbWords = true ;
	
	return [
		'title' => $faker->text(15), 
		'research_description' => $faker->sentence(8, $variableNbWords),
		'abstract' => $faker->realText(150,true),
		'school_id' => $schoolArray , 
		'posted_by'  => $studentArray,
		'attachment_url' => $faker->url , 
		'attachment' => $fileName,
		// $users = request()->file('attachment')->store('papers', 'public')
	];
});

$factory->define(App\Photo::class, function(Faker $faker ) { 


}); 

$factory->define(App\PaperActivity::class, function (Faker $faker) {
	$paperId = Paper::pluck('id')->toArray();
	$creatorId = User::pluck('id')->toArray();		
	$activityTypeId = ActivityType::pluck('id')->except(5)->toArray();		

	$actId = collect([
		'Paper_id' => $paperId, 
		'creator_id' => $creatorId, 
		'activityTypeId' => $activityTypeId
	]);

	dd($actId);	

	return [
		'paper_id' 			=> array_random($paperId),
		'creator_id' 		=> array_random($creatorId),
		'activity_type_id'  => array_random($activityTypeId),
		// 'display_name'	    => 	
		// 'body'   			=>	
	];
});
