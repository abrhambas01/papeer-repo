@extends('layouts.master')

@section('title', 'Recent Activity')

@section('content')

@includeWhen(auth()->check(),'partials.header')

@includeWhen(auth()->check(), 'partials.main-menu')

<div style="margin-left:6.9rem">
	
<h3 class="mt-4 mb-4 font-bold text-2xl">Activities for you, {{ auth()->user()->full_name }}</h3>

{{-- @php
	dump($papers);
@endphp
 --}}
@include('partials.activity')


@endsection