<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth ;
use App\PaperLike;
use App\PaperActivity;
use DB  ; 
use App\Paper ;

class UserController extends Controller
{
  

  public function profileUser(){
    $profileUser = auth()->user();
    return view("profiles.logged-on-user",compact("profileUser"));
  }  

  public function userPapers()
  {

    $userPaper = auth()->user()->with('activityPapers');
    
    dd($userPaper);

    // dd(auth()->user()->papers()->count());
  }

  public function returnsValueIfUserMadeAnActivity($paper){
    
   $activityId = request('activityId');

   $likeCount = PaperActivity::where([
    ['creator_id','=', Auth::id()],
    ['paper_id','=', $paper],
    ['activity_type_id','=',$activityId]
  ])->count();

   return response($likeCount, 200);

 }

 public function returnsLikedPapers($paper)
 {
  $paper = intval(request('paperId'));
  $likeCount  =  auth()->user()->hasLiked($paper, Paper::class);

  if ($likeCount == true) {
    $status = 1; 
  }
  else {
    $status = 0 ; 
  }

/*
      // $user = auth()->user() ; 
   $likeCount = DB::table("followables")->where([
    ['user_id','=', Auth::id()],
    ['followable_id','=', $paper],
    ['followable_type','=', 'App\Paper'],
  ])->count();

*/   return response($status, 201);



}



}
