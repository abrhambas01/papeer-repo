<?php

namespace App\Http\Controllers\Api;

use App\Paper ;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User ;

class PapersSchoolController extends Controller
{

	/*Returns the papers who has title of   */
	public function returnsPapersWhoWereWrittenByUser()
	{
		$paper = Paper::with('publisher')->where('posted_by',auth()->id())->first();
		return $paper ; 
	}



	/**
	 * returns activities for the student..
	 * - activity_types to be shown (recommendation / collaboration)
	 * - who created_the_request 
	 * @used for returning description
	 */
	public function returnsActivityForStudent($userId)
	{

		if (auth()->check() == false) {
			abort(403, "Unauthorized");
		}


		$userId = auth()->id();
		
		// ->  original ->notes.txt
		
		$papers = Paper::where('posted_by','=',$userId)->has('activityCreators')
		->with('activityCreators','activityTypes')
		->get();

		$activityCreator = $papers->flatMap->activityCreators ; 

		// dump($activityCreator);

		$activityType = $papers->flatMap->activityTypes ; 
		
		// dump($activityType);

		return view("papers.student-activity",[
			'papers' => $papers,
			'activityCreators' => $activityCreator ,
			'activityTypes' => $activityType 
		]);


	}

}
