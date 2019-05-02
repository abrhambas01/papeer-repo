<?php

use Faker\Generator as Faker;

$factory->define(App\School::class, function (Faker $faker) {
	$school_title = ['College','University'] ;
    return [
    	'name' => $faker->name." ".array_random($school_title),
    	'description' => $faker->sentence(10,true)
    ];
});
