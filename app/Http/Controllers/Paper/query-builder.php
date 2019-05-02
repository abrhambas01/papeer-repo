<?php

namespace App\Http\Controllers\Paper;


class QueryBuilder {

	public function checkData(){
		
		$users = DB::table('users')->where('admin', true)->orWhere(function($query){
			$query->where('plan','premium')->where('is_plan_owner',	true);			
		})->get();
	}

	public function returnContact($value='')
	{

		return Contact::where('vip', true)->get()->map(function($contact){
			$contact->formalName ="The exalted {$contact->first_name} of	the									{$contact->last_name}s";
			return	$contact;				
		}); 

	}



	public function ($value='')
	{
		
		$contacts = Contact::with(['addresses'=> function($query){
			$query->where('mailable',	true); }
		])->get();


	}


}


