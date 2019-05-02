<?php
namespace App\Console\Classes; 
use App\User ; 
use Auth ; 
use App\Paper ; 

/**
* I used this class for testing the queries for this app..
*/ 

class TestCollection  { 


protected function authUser(){
	return auth()->id(); 
}

public function whereNotIn($value='')
{
# code...

	$result = Requests::whereNotIn('status_id', [4, 5])
	->join('users', 'users.id', '=', 'requests.user_id')
	->join('categories', 'categories.id', '=', 'requests.category_id')
	->join('statuses', 'statuses.id', '=', 'requests.status_id')
	->where('rewards_number', '=', $id)
	->select('requests.id as request_id', 'requests.created_at','requests.updated_at',DB::Raw('format(TIMESTAMPDIFF(MINUTE,requests.updated_at, NOW()),0) as duration_in_minutes'), 'categories.name as category', 'statuses.name as status')
	->get();
}

public function returnsActivitiesForAStudent()
{
// get the user who is a student that has a paper and that paper should at least have an activity and pluck this user.id
	$paper = Paper::where('posted_by','=',2)->has('activityCreators')
	->with('activityCreators','activityTypes')->get()->unique()->toArray();



    dd($paper);
}

public function returnsOther()
{
	$jennyIGotYourNumber = Contact::whereHas('phoneNumbers', function($query){				
		$query->where('number',	'like',	'%867-5309%');
	});

}

public function testingAlertsWithMultipleRelationships($value='')
{

	$alerts = Alert::with(['product','user'])->whereHas('product', function($q){
		$q->where('saleprice1', '<', DB::raw(alert.amount));
	})->get();


}


public function constrainEagerLoads()
{

	return Contact::with(['addresses' => function($query){	
		$query->where('mailable', true);
	}])->get();

}


public function testingQuery2()
{
// you may have the logged in student in your hand.
// for the example, I'll take the first.
	$logged_in_student = Student::first();

	$other_students = Student::where('department_id', $logged_in_student->department_id)
	->whereDoesntHave('requestts', function($query) use($logged_in_student) {
		$query->where('Rec_id', $logged_in_student->id);
	})
	->get();


}


public function convertLaravel()
{
// code...

/*
DB::select("SELECT u.id,c.conversation_key,u.user_name,u.email
         FROM conversation c, user_profile u
         WHERE CASE 
         WHEN c.user_one = '8790'
         THEN c.user_two = u.id
         WHEN c.user_two = '8790'
         THEN c.user_one= u.id
         END 
         AND (
         c.user_one ='8790'
         OR c.user_two ='8790'
         )
         Order by c.conversation_key DESC Limit 20");*/


         $userId = 8790;

         $data['conversations'] = Conversation::selectRaw('user_profile.id, conversation_key, user_profile.first_name, user_profile.email')->where(function ($q) use ($userId) {
         	$q->where('user_one', $userId)
         	->orWhere('user_two', $userId);
         })->join('user_profile', function ($join) use ($userId) {
         	$join->on('user_profile.id', '=', 'conversation.user_one')->where('conversation.user_one', '!=', $userId)
         	->orOn('user_profile.id', '=', 'conversation.user_two')->where('conversation.user_two', '!=', $userId);
         })->orderBy('conversation_key', 'DESC')
         ->take(20)
         ->get();

 }


     public function activityFeeds()
     {
     	$studentId = User::students()->first()->value('id') ;


// try to log in the user..



// $auth = Auth::loginUsingId($student);


// dd($student);


     	$user = User::with('activities')->take(3)->get();

// dd($user);
// dd(User::take(3)->get()->toArray());

     }

 }