<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
	protected $table = "paper_activity_types";
	
	/**
	 * 
	 * Activity Type belongs to an Activity.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function activity()
	{
		// belongsTo(RelatedModel, foreignKey = activity_id, keyOnRelatedModel = id)
		return $this->hasOne(PaperActivity::class,'activity_type_id','id');
	}

/*
	public function papers()
	{
    // belongsTo(RelatedModel, foreignKey = activities_id, keyOnRelatedModel = id)
		return $this->belongsToMany(Paper::class,'paper_activities','activity_type_id','paper_id');
		
	}

	public function activityUsers()
	{
    // belongsTo(RelatedModel, foreignKey = activities_id, keyOnRelatedModel = id)
		return $this->belongsToMany(User::class,'paper_activities','activity_type_id','creator_id');
		
	}*/



}
