@extends('layouts.master')


@section('title', 'Home')

@section('content')

@includeWhen(auth()->check(),'partials.header')
@includeWhen(auth()->check(), 'partials.main-menu')

<h3 class="ml-12 text-2xl mt-8 mr-2">Welcome, {{ auth()->user()->full_name}}
</h3>

@endsection
