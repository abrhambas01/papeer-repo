<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/


Route::get('/', function () {
	if (auth()->check()) {
		// code...
		// dump("check login");
		return redirect()->to('home');
	}
	else  { 
		return view('index');	
	}
});



Route::get("user/papers","UserController@userPapers");

Route::get('api/papers/liked/{paper}', "UserController@returnsLikedPapers")->name('api.papers.user.liked');

Route::get('api/papers/activity/{paper}', 'UserController@returnsValueIfUserMadeAnActivity')->name('api.papers.user.activity');



Route::get("api/user",function(){
	dd(Auth::user()->full_name  ."Role:" .Auth::user()->role->title);
});	


Route::get('api/papers/activity/student/{student}', 'Api\PapersSchoolController@returnsActivityForStudent')->name('api.papers.student.activity');


Route::get("api/publisher","Api\PapersSchoolController@returnsPapersWhoWereWrittenByUser");

Route::get("api/user/role",function(){
	dd("User is a ".str_singular(auth()->user()->role->title));
});


Route::get('/user/likesCount',function (){
	return auth()->user()->likes(App\Paper::class)->count();
});

/*retrieving how many activities for a student*/

Route::group(['middleware' => 'auth', 'namespace' => 'Paper'], function (){
// used for papers.. resources
	Route::resource("papers","PapersController");

	Route::delete("papers/remove","PapersController@deletePaper")->name("papers.delete");

	Route::get("papers/followed/{user}","PapersController@followedPapers")->name("papers.followed");
	Route::get("papers/posted/{user}","PapersController@postedPapers")->name("papers.posted.user");
	Route::get("papers/recommend/{paper}","PapersController@recommendPapers")->name("papers.recommend.user");
	Route::get("papers/delete/more2","PapersController@deletePapersWhoHaveMoreThanTwoRecords")->name("papers.delete.user");

	
	Route::get("/activities","PapersActivitiesController@activityFeed")->name("activity");
	Route::post('activity/{paper}','PapersActivitiesController@activityRequest')->name("papers.activity");
	
	Route::post('papers/like/{paper}','PapersActivityController@startActivity')->name("papers.like");
	Route::post('papers/follow/{paper}','PapersActivityController@startActivity')->name("papers.follow");



});


Route::get("profiles/user/{user}","UserController@profileUser")->name("profiles.user");

Route::get("schools","SchoolController@index")->name('schools');


// Route::get("school/{school}","SchoolsController");

Auth::routes();
Route::get("logout","AuthController@logout")->name("logout");
Route::post("/login","AuthController@postLogin")->name("postLogin");
Route::post("/register","AuthController@postRegister")->name("postRegister");
Route::get('/home', 'HomeController@index')->name("home");


Route::get("/db/remove/photos/papers","DatabaseController@removePhotosToPapers");	
Route::get("/db/followables/trunc","DatabaseController@eraseFollowables");	

Route::get("/db/papers/erase","DatabaseController@erasePapersAndPhotos");


Route::get("names",function(){

	$collection = collect(['taylor', 'abigail', null])->map(function ($name) {
		return strtoupper($name);
	})->reject(function ($name) {
		return empty($name);
	});

	dd($collection);

});