@extends('layouts.master')	

@section('title', 'Home')

@section('content')

@includeWhen(auth()->check(),'partials.header')

@includeWhen(auth()->check(), 'partials.main-menu')


@if (auth()->user()->isStudent())

		<h3 class="ml-12 text-2xl mt-8 mr-2">Welcome, {{ auth()->user()->full_name }}, Student # {{ auth()->user()->student->student_school_id }}
		</h3>

@else

@endif



<div class="container mx-auto w-1/4">
	<div class="bg-white p-6 w-full" style="margin-left: -400px;
	margin-top: 30px;">
	<p class="ml-12 text-2xl font-bold">{{  auth()->user()->papers()->count() }}</p>
	<p class="text-3xl ml-10 font-bold">Number of Users</p>
</div>
</div>

@endsection

