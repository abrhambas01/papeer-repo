@extends('layouts.master')

@section('title', 'Student Activity')

@section('content')

@forelse ($activityTypes as $actType)

<article class="article-feeds mb-4">	

	<div class="flex ml-4" id="papersInformation">	

		<div class="flex-1">

			<a href="#" class="text-app-blue no-underline">
				<h3 class="mt-4 font-basic text-2xl">
				
				<p>Activities for students should show here..</p>
				


				</a>
			</div>
		</div>
</article>
@empty


<h3>No papers here.</h3>

@endforelse

@endsection