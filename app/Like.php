<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	/**
	 * Like belongs to a Paper.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function paper()
	{
		// belongsTo(RelatedModel, foreignKey = paper_id, keyOnRelatedModel = id)
		return $this->belongsToMany(Paper::class,'like_paper')->withTimeStamp('liked_on');
	}
}
 	