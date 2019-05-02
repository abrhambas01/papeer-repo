<?php
namespace App\Http\Controllers\Api;
use App\Paper ;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User ;


class PapersSchoolController extends Controller
{


	/**
	 * returns activities for the student..
	 * - activity_types to be shown (recommendation / collaboration)
	 * - who created_the_request 
	 * @used for returning description
	 */
	public function returnsActivityForStudent($userId)
	{

		$userId = auth()->id();

		return Paper::where('posted_by','=',$userId)->has('activityCreators')
		->with('activityCreators','activityTypes')
		->get()
		->unique();

	}

}
