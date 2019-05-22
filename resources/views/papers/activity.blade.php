@extends('layouts.master')

@section('title', 'Recent Activity')

@section('content')

@includeWhen(auth()->check(),'partials.header')

@includeWhen(auth()->check(), 'partials.main-menu')


<div style="margin-left:6.9rem">
	
	<h3 class="mt-4 mb-4 font-bold text-2xl">Activities for you, {{ auth()->user()->full_name }}</h3>


	@forelse ( $papers['activityCreator'] as $activityCreators )		

	<article class="article-feeds mb-4">	

		<div class="flex ml-4" id="activitiesInformation">	
			
			<div class="flex-1">
				<a href="#" class="text-app-blue no-underline">
					<h3 class="mt-4 font-basic text-2xl">

						@php 

						$activityType = $papers['activityType']->each(function($item,$key){	
							return $item->value('id');
							
							switch ( $item->value('id')) {

								case 1:
								$activityTypePhrase = $activityCreator ." Recommended to your paper " .$route  ;
								break;	

								
								case 2 :
								$activityTypePhrase = $activityCreator ." wants to collaborate with your paper".$route; 
								break;


								case 3:
								$activityTypePhrase = $activityCreator ." Liked your paper".$route ; 
								break;


								default:
								# code...
								break;
							}

						})->dump();

						// $activityTypeId = $activityType ; 			

						// dump($activityTypeId);

						// $activityCreator = $activityCreators->full_name ; 
						
						// $activityCreator->dump(); 


						

				/*		switch ($activityTypeId) {

							case 1:
							$activityTypePhrase = $activityCreator ." Recommended to your paper " .$route  ;
							break;	

							case 2 :
							$activityTypePhrase = $activityCreator ." wants to collaborate with your paper".$route; 
							break;

							case 3:
							$activityTypePhrase = $activityCreator ." Liked your paper".$route ; 
							break;

							case 4 : 
							$activityTypePhrase = $activityCreator ."Followed" ."your paper".$route ; 
							break;

							case 5 : 
							$activityTypePhrase = "You've published the paper : " .$route ;
							break;

							default : 
							$activityTypePhrase = "That is an invalid activity"; 
							break ;

						} */


						// $actCreators->id

						// $activityTypeId   = $activityType->id ;
						// dump($activityType);
						
						
/*
						$activityCreator = $actCreators[0]->pivot->display_name;

						
						// $activityCreator  = "Static first";
						
						$route  = "Static route";

						


						switch ($activityTypeId) {

							case 1:
							$activityTypePhrase = $activityCreator ." Recommended to your paper " .$route  ;
							break;	

							case 2 :
							$activityTypePhrase = $activityCreator ." wants to collaborate with your paper".$route; 
							break;

							case 3:
							$activityTypePhrase = $activityCreator ." Liked your paper".$route ; 
							break;

							case 4 : 
							$activityTypePhrase = $activityCreator ."Followed" ."your paper".$route ; 
							break;

							case 5 : 
							$activityTypePhrase = "You've published the paper : " .$route ;
							break;

							default : 
							$activityTypePhrase = "That is an invalid activity"; 
							break ;

						} 
*/

						@endphp

						{{-- @endforeach --}}

						<p class="text-black">
							{{-- {{  $activityTypeId }} --}}
						</p>		
					</h3>
				</a>				

			</div>
		</div>

	</article>

	@empty

	<p class="text-xl font-display">We don't have any activities listed for you</p>

</div>

@endforelse



@endsection