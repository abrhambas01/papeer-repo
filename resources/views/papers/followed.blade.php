@extends('layouts.master')

@section('title', 'Followed Papers')
@section('content')


@includeWhen(auth()->check(),'partials.header')
@includeWhen(auth()->check(), 'partials.main-menu')


<div style="margin-left:6.9rem">
	<h3 class="mt-4 mb-4 text-3xl font-sans-2">Your Followed Papers</h3>
</div>
<div class="container-fluid mx-auto mr-4 ml-4">
<article class="timeline-feeds bg-white h-12"></article>
</div>

@endsection