{{-- 

@forelse ( $activities as $activity)
<p class="text-3xl">{{  $activity->id }} {{  $activity->title }} </p>


		@foreach ($activity->activityTypes as $actType)
			<p> Activity Type : {{  $actType->activity_type }}</p>
			<p> Activity Type : {{  $actType->full_name }}</p>
		@endforeach

		@foreach ($activity->activityCreators as $actCreator)
				<h3>Activity Creator : {{ $actCreator }}</h3>
		@endforeach
		--}}
		{{-- <p>{{  $activity->activityCreators[0] }}</p> --}}
{{-- @empty

<p class="text-xl font-display">You haven't had any activities<p/>
	
@endforelse
--}}

@forelse ( $papers as $paper )

<article class="article-feeds mb-4">	
	<div class="flex ml-4" id="activitiesInformation">	
		<div class="flex-1">
			
			@foreach ($paper->activityTypes as $actType )

			<div>

				@if ($actType->activity_type == 5 )

					<?php 
					
					$activityType = "You Published a paper"
					
					?>
						
				@else

				<?php
					$activityType = $actType->activity_type; 
				?>
				@endif

				<p class="font-bold">{{ $activityType }} for {{  $paper->title }} </p>

			</div>
			@endforeach

		</div>
	</div>

</article>

@empty

<p class="text-xl font-display">You don't have any activities listed for you</p>

</div>

@endforelse
