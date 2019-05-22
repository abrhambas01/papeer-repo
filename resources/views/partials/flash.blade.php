{{-- <div class="flex items-center justify-between"> --}}
<div class="flex items-center justify-between">
	@if(session()->has('flash'))
		<div id="flashMessage" class="flex mr-4 w-full bg-alert-success font-sans h-12 text-sm mb-4 p-2 text-white">
			<p class="ml-10 mt-2 text-xl font-display">{{  session('flash') }}</p>
		</div>
	@endif
</div>

