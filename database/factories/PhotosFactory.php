<?php

use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
	$attachmentLocation = $faker->file($storageDir, $targetDir , true); 
	$fileInfo = pathinfo($attachmentLocation);
	$fileName = $fileInfo['basename'];
	$imageAbleType = array_random(['App\Paper','App\User']);

	return [
		'image_file' => $fileName, 
		'imageable_id' => 1,
		'imageable_type' => 'App\Paper',
	];
});
