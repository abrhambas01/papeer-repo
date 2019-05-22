<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

	protected $guarded = [];

	/**
	 * Photo morphs to models in imageable_type.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function imageable()
	{
		// morphTo($name = imageable, $type = imageable_type, $id = imageable_id)
		// requires imageable_type and imageable_id fields on $this->table
		return $this->morphTo();
	}

}
