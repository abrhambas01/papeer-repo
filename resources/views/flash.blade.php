<div class="flex items-center justify-between">
	<div id="flashMessage" class="flex mr-4 w-full bg-alert-success font-sans h-10 text-sm mb-4 p-2 text-white">
		@if (session()->has('flash'))
		<p class="ml-10 mt-4">{{  session('flash') }}</p>
		@endif
	</div>
</div>
