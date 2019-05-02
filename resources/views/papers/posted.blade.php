@extends('layouts.master')

@section('title', 'Papers Posted by you')

@section('content')

@includeWhen(auth()->check(),'partials.header')

@includeWhen(auth()->check(), 'partials.main-menu')


<div style="margin-left:6.9rem">
	<h3 class="mt-4 mb-4 font-sans">Your Posted Papers</h3>
	
	@forelse ($papers as $paper)

	<article class="article-feeds mb-4">	
		<div class="flex ml-4" id="papersInformation">	
			<div class="flex-1">
				<a href="{{ route('papers.show',$paper->id) }}" class="text-blue">
					<h3 class="mt-4 font-basic text-2xl">{{  $paper->title }} by {{  $paper->publisher->full_name }}</h3>
				</a>
				<p class="mt-2 mb-2 text-normal font-medium font-sans">{{  $paper->research_description }}</em></p>
				<h3 class="mt-4 text-2xl text-bold">Abstract</h3>
				<p class="mt-2 text-normal font-medium font-sans">{{ $paper->abstract }}</em></p>

			</div>

			<div id="user-actions">
				<div class="flex">
					<svg id="deleteButton" class="h-4 text-red fill-current w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/>
					</svg>
				</div>
			</div>
		</div>
	</article>

	@empty

	<tr>

		<td>You have not posted any papers on our site yet..</td>

	</tr>
	
	@endforelse
</div>

@endsection

@section('scripts')

<script>

	$(function(){

		var paper  = '{{  $paper }}';

		console.log(paper);
	});

	$('#user-actions').find('svg#deleteButton').on('click',function (e){
		var this = $(this);

		console.log(paper);
		console.log(this);
	});
</script>

@endsection