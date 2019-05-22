@extends('layouts.master')

@section('title', 'All regitered schools')

@section('content')


@includeWhen(auth()->check(),'partials.header')

@includeWhen(auth()->check(), 'partials.main-menu')

<div style="margin-left:6.9rem">
	<h3 class="mt-4 mb-4 font-sans">All Parnter Schools around the world</h3>


	@forelse ($schools as $school)

	<article class="article-feeds mb-4 w-1/4">	
		<p> {{ $school->name }}</p>
	</article>



	@empty

	<tr>
		<td>Nothing here.</td>
	</tr>

	@endforelse


</div>


@endsection