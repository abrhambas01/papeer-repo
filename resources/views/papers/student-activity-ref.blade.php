@extends('layouts.master')

@section('title', 'Student Activity')

@section('content')

@forelse ($activityTypes as $actType)

<article class="article-feeds mb-4">	

<div class="flex ml-4" id="papersInformation">	

<div class="flex-1">

	<a href="#" class="text-app-blue no-underline">
		<h3 class="mt-4 font-basic text-2xl">
			{{-- {{  $actType->activity_type }} --}}
			
			@php
			$activityTypeId   =  	    $actType->id ;
			$activityCreator  =		    $actType->pivot->display_name;
			$paperId          =         $actType->pivot->paper_id;
			$route            =         `<a class="text-black" href="{{ route('papers.show',$paperId) }}"></a>` ; 
			

			switch ($activityTypeId) {
				case 1:
				$activityTypePhrase = $activityCreator ." Recommended to your paper " .$route  ;
				break;	

				case 2 :
				$activityTypePhrase = $activityCreator ." wants to collaborate with you on your paper".$route; 
				break;

				case 3:
				$activityTypePhrase = $activityCreator ." Liked your paper".$route ; 
				break;
				
				case 4 : 
				$activityTypePhrase = $activityCreator ." Followed" ."your paper".$route ; 
				break;

				case 5 : 
				$activityTypePhrase = "You've published paper : " .$route ;
				break;

			}

			@endphp
			<p class="text-black">{{  $activityTypePhrase }}</p>		
		</h3>
		
	</a>

	{{-- @endforeach --}}


{{-- 
	@foreach($activityTypes as $actType)
		<p class="mt-2 mb-2 text-normal font-bold font-sans">{{  $actType->activity_type }} </p>
		@endforeach --}}
		{{-- <h3 class="mt-4 text-xl">Abstract</h3> --}}

		{{-- <p class="mt-2 text-normal font-medium font-sans"> --}}
			{{-- {{  str_limit($paper->abstract, 100) }} --}}
		{{-- </em> --}}

	</div>
</div>
</article>
@empty


<h3>No papers here.</h3>

@endforelse

@endsection