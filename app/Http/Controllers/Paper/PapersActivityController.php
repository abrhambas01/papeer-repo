<?php
namespace App\Http\Controllers\Paper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paper ; 
use App\PaperLike ; 
use DB ; 
use Carbon\Carbon ; 
use App\utilities\PaperActivity ; 

class PapersActivityController extends Controller
{

	use PaperActivity ; 

	public function followPaper($paper)
	{
// return response()->json($paper, 201);
// testing if json is request..
// $this->testIfRequestIsJson(request());
		$userId = intval(request()->get("userId")) ;
		if (auth()->check() == false) {

			$errorMessage = "You cannot follow this, please log-in";

			abort(501, $errorMessage);
		}

		else {
			$likeStatus  = DB::table("paper_like")->insert([
				'user_id' => $userId , 
				'paper_id' => $paper 
			]) ; 

			if ( $likeStatus == true) {
				Paper::incrementStatus();
				return response($likeStatus, 201);
			}
			else { 
				$likeStatus  = DB::table("paper_like")->where([
					'user_id' => $userId , 
					'paper_id' => $paper 
				])->delete() ; 

				return response($likeStatus, 500); 
			}
		}
	}

	protected function todaysTime()
	{
		return Carbon::now('Asia/Manila');
	}


/*used for */

	public function startActivity($paper)
	{
		$userId = intval(request()->get("userId")) ;

		$activityId = intval(request()->get('activityId')) ;

		$paperId = intval($paper);


		if (auth()->check() == false) {
			$errorMessage = "You cannot like this paper... please log-in, now";
			abort(501, $errorMessage);
		}

		else { 
		// if the one who likes the paper happens to be the owner then don't allow that to happen 

			$paperOwner =  Paper::where('id','=',$paperId)->value('posted_by') ; 					

			if ( $paperOwner == $userId ) {
				$errorMessage = "You cannot like or follow your own paper" ;
				return response($errorMessage,403 );
			// abort(403,$errorMessage);
			}

			switch ($activityId) { 
		// like a paper
				case 3 : 
				$paper = Paper::findOrFail($paperId);
				// else start the liking..
				return $this->toggleLike($paper)	;

				break;

		// follow a paper.
				case 4 :
				$paper = Paper::findOrFail($paperId);
				
				// else toggle follow..
				return $this->toggleFollow($paper)	;
				break;
			}

		}



		// dd(request());
	}


	public function likePaper($paper)
	{
// testing if json is a request just use this method..
//-> $this->testIfRequestIsJson(request());
		$userId = intval(request()->get("userId")) ;

	// if user is not logged on.
		if (auth()->check() == false) {
			$errorMessage = "You cannot like this paper... please log-in, now";
			abort(501, $errorMessage);
		}

		else {
	// get the user_id / posted_by column of the paper specified..
			$paperOwner =  Paper::where('id','=',$paper)->value('posted_by') ; 	

		// if the one who likes the paper happens to be the owner then don't allow that to happen 
			if ( $paperOwner == $userId ) {
				$errorMessage = "You cannot like your own paper" ;
				return response($errorMessage,403 );
			// abort(403,$errorMessage);
			}

		//  you can now like/unlike this paper. .. 
			else {

			// counts if the logged on user liked the paper..
				$paperLikeStatus = PaperLike::where([
					'user_id' => $userId , 
					'paper_id' => $paper 
				])->count();

				if ($paperLikeStatus == 0) {
				// start liking

					// dd("You can now start liking");

					$likeStatus = PaperLike::create([
						'user_id'  => $userId , 
						'paper_id' => $paper ,
						'liked_on' => $this->todaysTime() 
					]);

				// returns true if a request was created..
					$dataIsInserted = $likeStatus->wasRecentlyCreated ;  

				// if its inserted in the db.. 
					if ( $dataIsInserted == true) {
				// update the increment status
						$likeMessage = Paper::where("id",'=',$paper)->increment('likeCount', 1);

						
						$likesCount = Paper::where('id','=',$paper)->value('likeCount');

						// then insert to the paper_activities.. 

						DB::table('paper_activities')->insert([ 
							'paper_id' =>  intval($paper), 
							'creator_id' => $userId,
							'status' => NULL , 
							'activity_type_id' => 3, // like the status code
						]);

						

						return response([
							'likeCount' => $likesCount,
							'likeStatus' => 1
						], 201);

					}
						// $paper = PaperLike::where('')
				}
				else {
					// dd("Unliking..");
					$unlikeStatus = PaperLike::where([
						'user_id' => $userId , 
						'paper_id' => $paper 
					])->delete();

					$unlikeStatus = Paper::where("id",'=',$paper)->decrement('likeCount', 1);
					$unlikeCount = Paper::where('id','=',$paper)->value('likeCount');
					$res = 0 ;
					
				// we'll just remove this 
					DB::table('paper_activities')->whereColumn([
						'paper_id', '=', $paper ,
						'user_request_id', '=', $userId, 
						'activity_type_id', '=', 3 
					])->delete();

					return response([
						'unlikeCount' => $unlikeCount,
						'likeStatus' => $res
					], 201);
					// $likeMessage = Paper::updateLikesCount($dataInserted,$paper);
					// dd($likeMessage);
					// $likeMessage = Paper::updateLikesCount($likeStatus,$paper);
					// return response($likeStatus, 500);
				}

			}

		}


	}	



}
