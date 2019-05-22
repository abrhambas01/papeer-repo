@extends('layouts.master')

@section('title', 'All Papers Posted')

@section('content')


@includeWhen(auth()->check(),'partials.header')

@includeWhen(auth()->check(), 'partials.main-menu')

<div style="margin-left:6.9rem">
	<h3 class="mt-4 mb-4 font-sans">All Posted Papers around the world</h3>

	@forelse ($papers as $paper)

	<article class="article-feeds mb-4">	
		<div class="flex ml-4" id="papersInformation">	
			<div class="flex-1">
				<a href="{{ route('papers.show',$paper->id) }}" class="text-app-blue  no-underline "><h3 class="mt-4 font-basic text-3xl">{{  $paper->title }} by {{  $paper->publisher->full_name }}</h3>
				</a>
				<p class="mt-2 mb-2 text-normal font-medium font-sans">{{  $paper->research_description }}</em></p>
				<h3 class="mt-4 text-xl">Abstract</h3>
				<p class="mt-2 text-normal font-medium font-sans">
					{{  str_limit($paper->abstract, 100) }}</em>
				</p>

			</div>
		</div>
	</article>
	
	@empty

	<tr>
		<td>Nothing here.</td>
	</tr>

	@endforelse

	{{ $papers->links() }}

</div>


@endsection