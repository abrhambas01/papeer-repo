<?php 
namespace App\Http\ViewComposers;
use App\Country ; 
use Illuminate\View\View;

class StudentMenu { 

	public function compose(View $view)
	{
		// we need to pass how many activities does a student has..
		// we'll get the user_id of the logged on user..
		$user = auth()->id();

		$papersOfTheUser = \App\Paper::where("posted_by",$user)->pluck('id'); // 7,10
	// retrieving the activities for the specific papers of the logged on user...
		$activitiesCount = \App\PaperActivity::whereIn("paper_id",$papersOfTheUser)->count();
	
        $view->with(['activityCount' => $activitiesCount]);


	}

}
