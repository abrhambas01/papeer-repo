@forelse ( $activities->activityTypes as $activityType )
<div class="bg-white p-4 w-1/3 mt-4">
<ul>
		<li>You've made a {{  $activityType->activity_type }} to {{-- <a class="ml-2 text-blue underline" href="{{ route('papers.show', $activity->id) }}">
			Paper
		</a> --}}
	</li>

		{{-- @if ( $activity->activity_type_id  === 2)
			<li>You made a collaboration request to
				<a class="ml-2 text-blue underline" href="{{ route('papers.show', $activity->paper_id) }}">
					Paper
				</a>
			</li>

		@elseif ( $activity->activity_type_id  === 3)
		<li class="text-xl font-semibold">{{ $activity->activity_type_id }}</li>
		@endif --}}
	</ul>
</div>
@empty

<p class="text-xl font-display">You have not made any activity on site.<p/>

</div>
@endforelse
