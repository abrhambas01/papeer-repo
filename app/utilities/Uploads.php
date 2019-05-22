<?php
namespace App\utilities ; 

trait Uploads { 

	public function publish()
	{
		$paper =  auth()->user()
		->papers()
		->create(['posted_by'=>   auth()->id(),
			'title'                 => $request->get('research_title'),
			'research_description'  => $request->get('research_description'),
			'abstract'              => $request->get('abstract'),
			'school_id'             => $request->get("school_id"),
			'likeCount'             => 0 ,
			'followersCount'        => 0,
			'attachment'            => $request->get()->file('attachment')->store('papers', 'public'),
			'attachment_link'       => $request->get("attachment_link")
		]);
	}


}

