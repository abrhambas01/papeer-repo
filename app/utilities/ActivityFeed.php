<?php 
namespace App\utilities;
use Zttp\Zttp; 
use App\Paper ;

class ActivityFeed {

	/*Just use polymorphic relationships for an easier setup*/
	public static function fetchActivities(){
	// if user isn't logged on..
		if (auth()->check() == false) {
			abort(403, "Unauthorized");
		}

		$userId = auth()->id();
		


	}



/*This will use polymop*/
	/*public static function fetchActivitiesForAStudent(){


		if (auth()->check() == false) {
			abort(403, "Unauthorized");
		}

		$userId = auth()->id();

		$papers = Paper::where('posted_by','=',$userId)->has('activityCreators')
						->with('activityCreators','activityTypes')
						->get();



		return collect(['activityCreator' => $papers->flatMap->activityCreators, 
						'activityType' => $papers->flatMap->activityTypes]) ; 
		

	}
*/
/*
	public static function fetchActivitiesforAnAdmin()
	{
		$userId = auth()->id();
		$papers = Paper::with('activityCreators','activityTypes')		
		                        ->where('creator_id','=',$userId)
		                        ->whereHas('papers')
	                        	->groupBy('id')
								->get();

		return $papers ;
	}
*/


}	

