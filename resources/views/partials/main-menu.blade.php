<?php
$id = auth()->user()->id 
?>

@includeWhen(auth()->user()->isStudent() == true, 'partials.main-menu.students')

@includeWhen(auth()->user()->isStudent() == false, 'partials.main-menu.non-students', ['id' => $id])


{{-- @component('main-menu')

<div class="bg-white-2 shadow" id="studentMenu">
	<div class="flex px-4 py-4 pb-4 pt-4 font-sans">
		<svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-grey-darkest h-6 w-6 mr-2" viewBox="0 0 20 20"><path d="M8 20H3V10H0L10 0l10 10h-3v10h-5v-6H8v6z"/></svg>
		<a href="{{ route('home') }}" class="mr-8 text-2xl no-underline font-normal text-grey-darkest font-sans">Home</a>

		<svg class="fill-current text-grey-darkest h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 4h20v2H0V7zm0 4h20v2H0v-2zm0 4h20v2H0v-2z"/></svg>
		<a href="{{ route('papers.index') }}" class="mr-8  no-underline text-2xl font-normal text-grey-darkest font-sans">Browse Papers</a>

		<svg class="fill-current text-grey-darkest h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9 10V8h2v2h2v2h-2v2H9v-2H7v-2h2zm-5 8h12V6h-4V2H4v16zm-2 1V0h12l4 4v16H2v-1z"/></svg>
		<a href="{{ route('papers.create') }}" class="mr-8 no-underline text-2xl font-normal text-grey-darkest font-sans">Followed Papers</a>

		<svg class="fill-current text-grey-darkest h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M1 4h2v2H1V4zm4 0h14v2H5V4zM1 9h2v2H1V9zm4 0h14v2H5V9zm-4 5h2v2H1v-2zm4 0h14v2H5v-2z"/></svg>
		<a href="{{ route('activity') }}" class="mr-8 no-underline text-2xl font-normal text-grey-darkest font-sans">Activities
		</a>

		<svg class="fill-current text-grey-darkest h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 18h12V6h-4V2H4v16zm-2 1V0h12l4 4v16H2v-1z"/></svg>	
		<a href="{{ route('papers.show.user',$id)}}" class="mr-8 no-underline text-2xl font-normal text-grey-darkest font-sans">Browse Posted Papers</a>

		<svg  class="fill-current text-grey-darkest h-6 w-6 mr-2"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"/>
		</svg>

		<a href="{{ route('logout') }}" class="mr-8 no-underline text-2xl font-normal text-grey-darkest font-sans">Logout</a>
	</div>
</div>


@endcomponent --}}




{{-- 
@includeWhen(auth()->user()->isNotStudent() === false, 'partials.main-menu.students', ['some' => 'data'])
@includeWhen(auth()->user()->isNotStudent(), 'partials.main-menu.non-students', ['id' => $id])

 --}}