<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	public $timestamps = false ;
	/**
	 * Role belongs to User.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() 
	{
		// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
		return $this->hasOne(User::class,'role_id','id');
	}




}
