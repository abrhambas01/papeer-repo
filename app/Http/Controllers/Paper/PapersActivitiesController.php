<?php
namespace App\Http\Controllers\Paper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Paper ;
use App\PaperLike ;
use App\PaperActivity ;
use DB ;
use Auth ;
use Carbon\Carbon ; 	
use App\User ; 
use App\utilities\ActivityFeed ;

class PapersActivitiesController extends Controller
{

		/*
		return response()->json($paper, 201);
		testing if json is request..
		$this->testIfRequestIsJson(request());
		*/
		private function testIfRequestIsJson()
		{
			$message1 = 'This is a json request, sir';
			$message2 = 'This is a non json request, pal';

			if ( request()->isJson() ){
				return response($message, 201);
			}
			else { 
				return response($message2, 201);
			}
		}	


		/* Used for recommendation and collaboration purposes.. only..*/
		public function activityRequest($paperId)
		{

			$userId = auth()->id() ; 
			$activityId = intval(request()->get("activityId")) ;
			$paper_id = intval($paperId);

			// if it is a recommendation  request....
			if ($activityId == 1) {
			// message_body is required here and display-name

				$this->validate(request(), [
					'requestData.0.value' =>  'required|min:3',
					'requestData.1.value' =>  'required|min:15',
				]);

				$results = collect([
					'sender' => request()->input("requestData.0.value"),
					'body'   => request()->input("requestData.1.value")
											// 'complete' => request()->input("requestData")
				]);

				$sender = $results->get('sender');
				$body = $results->get('body');	

			// count kung pila na ang entry sa paper_activity..
				$paperActivityCount = PaperActivity::where([
					['creator_id','=', $userId ],
					['paper_id','=', $paperId],
					['activity_type_id','=', $activityId]
				])->count();

			// insert na daun diri.. kung ang recommendation kay nakasakto ra sa kadaghanon per day ..

				if ( $paperActivityCount < 3 ) {
					$activity = PaperActivity::firstOrCreate([
						'paper_id'		   => 	$paper_id,
						'creator_id' 	   => 	$userId , 
						'activity_type_id' =>	$activityId  ,
						'display_name'	   => 	$sender,
						'body' 			   => 	$body,
						'status' 	       => 	null ,
					]);


					if  ( $activity->id != null) { 
			// return response(['activity' => $activity->id], 201);
						return response(['message'  => 'You have added a new recommendation to the owner of this paper',
							'activity_id' => $activityId 
						],201);


					}

					else { 
						$message = 0;
						return response(['message' => 'You have added a new recommendation to the owner of this paper',
							'activity_id' => $activityId
						], 501);
					}
				}

			// if dli pd return ang message nga you have exceeded the amount of activity recommendation per day..
				else {
					return response(['message' => 'You are not allowed to add more recommendation',
						'activity_id' => $activityId ],403);
				}
			}

			// else if it is a collaboration request..
			else { 

			// validate the data..

				$this->validate(request(), [
					'requestData.0.value' =>  'required|min:10',
				]);

				$results = collect([
					'activityId' => $activityId,
					'note' => request()->input("requestData.0.value")
				]);

				$activity_id = $results->get('activityId');

				$note = $results->get('note');

				$paperActivityCount = PaperActivity::where([
					['creator_id','=', $userId ],
					['paper_id','=', $paperId],
					['activity_type_id','=', $activityId]
				])->count();

			// if it's more than 1
				if ( $paperActivityCount >= 1) { 
					return response(['message' => 'You already requested for a collaboration',
						'activity_id' => $activityId
					],403);
				}

				else {

					$activity = PaperActivity::firstOrCreate([
						'paper_id'		   => 	$paper_id ,
						'creator_id' 	   => 	$userId , 
						'activity_type_id' =>	$activityId ,
						'display_name'	   => 	auth()->user()->full_name,
						'body' 			   => 	$note,
						'status' 	       => 	'0' , 
			// not yet approved or the owner doesn't approve to share it's google drive. it yet..
					]);

					return response(['message' =>	'Your request for collaboration was just made.',
						'activity_id' => $activityId
					],201);
				}
			}

// we get the user id and the paper id
/*	$response = PaperActivity::create([
	'paper_id' => $paperId,
	'activity_type_id' => $activityId , 
	'user_id' => $userId,
	'status' => 0
]);

return response()->json($response,201);*/



}

/*returns activities for the logged on user.*/
	public function activityFeed(){
		if (auth()->user()->isStudent()) {
			echo  "Format is something like : John Doe has made a recommendation to your paper: " ; 

			$papers = ActivityFeed::fetchActivitiesForAStudent();

			$papers->dump() ;
						// Format looks like 
						// this one works. => printing out activity creator and then the type of the activity.
			foreach ($papers['activityCreator'] as $activityCreator) {

				$activityType = $papers['activityType']->each(function($item,$key){
							// return $item->pluck('id') ;  

					return $item->pluck('id');

					echo $activityCreator->pivot->display_name ."made a activity type in Paper Id  " .$activityCreator->pivot->paper_id ."<br/>" ; 

				})->dump() ;
						// switch()

			}



					// displaying..activity types
				/*
						foreach ($papers['activityType'] as $activityType){
							// echo "Activity Type : " .$activityType->id ."<br/>";


							switch($activityType->id){
								
								case 1:
								$activityTypePhrase = $activityCreator ." Recommended to your paper " .$route  ;
								break;	

								case 2 :
								$activityTypePhrase = $activityCreator ." wants to collaborate with your paper".$route; 
								break;

								case 3:
								$activityTypePhrase = $activityCreator ." Liked your paper".$route ; 
								break;

								case 4 : 
								$activityTypePhrase = $activityCreator ."Followed" ."your paper".$route ; 
								break;

								case 5 : 
								$activityTypePhrase = "You've published the paper : " .$route ;
								break;

								default : 
								$activityTypePhrase = "That is an invalid activity"; 
								break ;
							}

						}*/

				/*
						$activityType = $papers['activityType']->each(function($item,$key){
												// return array($item, $key); 
												// 0 , 1 , 2
							return $item->pluck('id'); 
						})->dd();*/

						// dd($activityType); 

						// return view("papers.activity", ['papers' => $papers]);
					}


					// non students activities... for example 
					else {

						dd("non students activities fetch..");
												// ActivityFeed::fetchAdminActivities() ; 
												// $activities = PaperActivity::with('type')->where("creator_id",'=',auth()->id())->get();
												// return view("papers.activity",compact('activities'));
					}

		}

}

