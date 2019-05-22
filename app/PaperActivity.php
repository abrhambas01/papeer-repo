<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperActivity extends Model
{
	/*used for recording activities by any user..*/
	/* this is a pivot table.. */


	protected $guarded = [];

    // public $timestamps = false ; 

	protected $table = 'paper_activities';

	/**
	 * an Activity has a type...
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function activity_type()
	{
		return $this->belongsTo(ActivityType::class,'activity_type_id','id');
		// hasOne(RelatedModel, foreignKeyOnRelatedModel = paperActivity_id, localKey = id)
	}	


	// public function papers()
	// { 
	// 	return $this->belongsToMany(Paper::class,'paper_activities','activity_id','paper_id')
	// 	     		->withPivot('display_name','body','status');
	// }

	/*has one person making the request....*/
	public function creator()
	{
		// hasOne(RelatedModel, foreignKeyOnRelatedModel = paperActivity_id, localKey = id)
		return $this->belongsTo(User::class,'creator_id','id');
	}



}
