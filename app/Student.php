<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	public $timestamps = true ; 

	protected $guarded = [];

	// protected $fillabl
	/**
	 * Student belongs to User.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
		return $this->belongsTo(User::class,'user_id','id');
	}	


	
	public function papers()
	{
		// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
		return $this->hasMany(User::class,'user_id','id');
	}

}
