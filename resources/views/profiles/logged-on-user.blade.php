@extends('layouts.master')

@section('title', 'User Profile')


@section('content')

@include('partials.header')

@include('partials.main-menu')


<div class="container mx-auto justify-between items-center text-blue p-10">
	<div class="bg-white p-4 w-1/2">	
		<div class="text-center">
			<img src="{{ asset('images/default_avatar.jpg') }}" class="h-24 w-24 rounded-full" alt="">
			
			<h3 class="text-grey-darker text-3xl">{{ auth()->user()->full_name }}</h3>

			<p class="text-black text-3xl">{{  $profileUser->email }} </p>
			<p>{{  $profileUser->username }}</p>
		</div>
	</div>
</div>


@endsection