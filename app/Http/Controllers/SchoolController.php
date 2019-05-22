<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School ;
class SchoolController extends Controller
{
	public function index()
	{
		$schools = School::all();
		return view("schools",['schools'=> $schools]);
	}

}
