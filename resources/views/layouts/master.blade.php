<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield("title")</title>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
<link href="{{ asset('css/uploadify.css') }}" rel="stylesheet">
<link href="{{ asset('css/trix.css') }}" rel="stylesheet">
<link href="{{ asset('css/other.css') }}" rel="stylesheet">
<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">

@yield("styles")

<script>
	window.App = {!! json_encode([
		'csrfToken' => csrf_token(),
		'user' => Auth::user(),
		'signedIn' => Auth::check(),
		'storePapers' => route('papers.store')
		]) !!}
</script>
	
</head>

<body class="bg-grey-lighter font-sans-2">

	@include('partials.flash')

	<div id="app">
		@yield("content")
	</div>

	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('js/trix.js') }}"></script>
	<script src="{{ asset('js/scripts.js') }}"></script>
	@yield('scripts')
	
</body>

</html>