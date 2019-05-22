<header class="bg-theme-color flex items-center p-3 h-18 justify-between text-white">	

	<p class="font-bold font-display text-3xl ml-10 theme-blue-lightest">Papeer</p>
	
	<div class="flex items-center mr-10">
		<h3 class="inline mr-4">{{  auth()->user()->full_name }}</h3>
		<svg xmlns="http://www.w3.org/2000/svg" class="relative fill-current h-6 w-6 dropDownNav" viewBox="0 0 20 20">
			<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
		</svg>
	</div> 
{{-- 
	<nav id="navMenu" class="relative bg-grey-lightest p-4">
		<ul>
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
		</ul>
	</nav> --}}
</header>
	

