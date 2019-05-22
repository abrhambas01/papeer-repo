<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon ;


class PaperLike extends Model
{
	protected $table = "like_paper";
	
	public $timestamps = false;
	
	protected $guarded = [];

	public function setLikedOnAttribute()
	{
		$this->attributes['liked_on'] = Carbon::now('Asia/Manila');
	}	


	// we want to see the  

	public function getLikedOnAttribute()
	{
		// $this->attributes['liked_on'] = Carbon::now('Asia/Manila');
	}




}
