@extends('layouts.master')

@section('title', 'Papeer')

@section('content')


@includeWhen(auth()->check(),'partials.header')

@includeWhen(auth()->check(), 'partials.main-menu')

<div class="max-w-app-container mx-auto">
	
	<form id="createPapers" enctype="multipart/form-data" action="{{ route('papers.store') }}" method="POST" class="w-1/2 max-w-md bg-white py-6 px-6 mt-8 ml-2" >

		{{ csrf_field() }}
		

		<h3 class="mb-4 font-display">Submit Research</h3>

		<hr class="bg-grey-lighter mb-4" style="height: 0.10rem;">

		<div class="flex flex-wrap -mx-3 mb-8">
			<div class="w-full md:w-full px-3 mb-6 md:mb-0">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
					Research Paper Title
				</label>
				<input name="research_title" id="research_title" class="appearance-none block w-full bg-grey-lightest text-grey-darker border border-grey rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Please fill out your research paper title..">
				{{-- <p class="text-red text-xs italic">Please fill out this field.</p> --}}
			</div>
		</div>

		<div class="flex flex-wrap -mx-3 mb-8">
			<div class="w-full md:w-full px-3 mb-6 md:mb-0">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
					Research Paper Description
				</label>
				<input name="research_description" id="research_description" class="appearance-none block w-full bg-grey-lightest text-grey-darker border border-grey rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Please fill the paper description ">
				{{-- <p class="text-red text-xs italic">Please fill out this field.</p> --}}
			</div>
		</div>


		<div class="flex flex-wrap -mx-3 mb-4">
			<div class="w-full px-3">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-password">
					Abstract of the Research
				</label>
			{{-- 	<textarea class="appearance-none block w-full bg-grey-lightest text-grey-darker border border-grey-darker rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-password" type="password" placeholder="******************">
			</textarea> --}}
			<input id="abstract" class="abstractContent" type="hidden" name="abstract">
			<trix-editor input="abstract" class="appearance-none block w-full bg-grey-lightest text-grey-darker border border-grey rounded py-4 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" input="x">
				
			</trix-editor>


		</div>
	</div>

	<div class="flex flex-wrap -mx-3 mb-4">
			{{-- <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-city">
					City
				</label>
				<input class="appearance-none block w-full bg-grey-lightest text-grey-darker border border-grey-lightest rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-city" type="text" placeholder="Albuquerque">
			</div> --}}
			<div class="w-full md:w-3/4 px-3 mb-6 md:mb-0">
				<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
					University / College 
				</label>
				<div class="relative">
					<select name="school_id" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-state">
						@foreach($schools as $school)
							<option value="{{  $school->id }}">{{ $school->name }}</option>
						@endforeach
					</select>
					<div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
						<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
					</div>
				</div>
			</div>
		</div>

		<div class="flex flex-wrap -mx-3 mb-6 mt-4">
			<div class="w-full md:w-3/4 px-3 mb-6 md:mb-0">
				<label class="block w-full uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
					<p class="w-full">Upload Document of your Paper(accepts doc and pdf files only)</p>
				</label>
				<input id="file_upload" id="attachment" name="attachment" type="file">
			</div>
		</div>

		<div class="flex flex-wrap -mx-3 mb-4">
			<div class="w-full md:w-3/4 px-3 mb-6 md:mb-0">
				<label class="block w-full uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
					<p class="w-full">or link your Google Docs </p>
				</label>
				<div id="queue"></div>
				<input name="attachment_link" id="attachment_link" type="text" class="appearance-none block w-full bg-grey-lightest text-grey-darker border border-grey rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Please fill the paper description ">
			</div>
		</div>


		@if ($errors->any())
			<div class="container">
				<div class="bg-color-error p-3 mb-4">
					<h2 class="text-white mb-2">
						There {{ $errors->count() == 1 ? 'is' : 'are' }} {{ $errors->count() }} {{ str_plural('error', $errors->count() )}} with this input
					</h2>
					<ul class="bullet-list text-white">
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif

		<div class="flex flex-wrap mb-1">
			<div class="w-full md:w-full">
				<button class="bg-green-dark py-3 px-8 w-full text-white font-bold ">Submit Research Paper</button>
				
			</div>
		</div>
	</form>


</div>

@endsection

@section('scripts')

<script src="{{ asset('js/jquery.uploadify.min.js') }}"></script>

<script type="text/javascript">
	<?php $timestamp = time();?>
	$(function() {
		$('#file_upload').uploadify({
			'formData'     : {
				'timestamp' : '<?php echo $timestamp;?>',
				'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
			},
			'swf'      : 'uploadify.swf',
			'uploader' : 'uploadify.php'
		});
	});
</script>

@endsection