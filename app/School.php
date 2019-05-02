<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{

	public function students()
	{
		return $this->hasMany(User::class);
	}

	
	public function papers()
	{
		return $this->hasMany(Paper::class);
	}



	/*
	A school has many students and each student has many papers.
	What if we want to get a school's list of papers -> that's has many through..

  schools
        id - integer
        display_name - string
        motto - string

    students
        user_id - integer (user_id)
        group_id - integer
        full_name - string

    papers
        id - integer
        group_member_id(group_members) - integer
        skill_name - string


	*/


	// public function schoolsPapers()
	// {
	// 	return $this->hasManyThrough(
	// 		Paper::class, 
	// 		Student::class,
	// 		''
	// 	);
	// }

}
