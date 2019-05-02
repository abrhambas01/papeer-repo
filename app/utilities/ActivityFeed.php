<?php 
namespace App\utilities;
use Zttp\Zttp; 
use App\Paper ;

class ActivityFeed {

	public static function fetchActivitiesForAStudent(){
		$userId = auth()->id();

		$papers = Paper::where('posted_by','=',$userId)->has('activityCreators')
		->with('activityCreators','activityTypes')
		->groupBy('id')
		->get();

		return $papers ;

	}


	public static function fetchActivitiesforAnAdmin()
	{

		$userId = auth()->id();

		$papers = Paper::with('activityCreators','activityTypes')

		                        where('creator_id','=',$userId)
								->with('papers','')
		                        ->whereHas('papers')
	                        	->groupBy('id')
								->get();

		return $papers ;
	}



}	

