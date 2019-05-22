@extends('layouts.master')

@section('title', 'Paper Page')

@section('styles')

<link rel="stylesheet" href="{{ asset('css/jquery-modal.min.css') }}">
<style>
/*trix-editor #, 
trix-toolbar # {
pointer-events: none;
}*/

.modal {
	max-width: 600px;
}
</style>
@endsection

@section('content')


@includeWhen(auth()->check(),'partials.header')

@includeWhen(auth()->check(), 'partials.main-menu')

<div style="margin-left:6.9rem">	
	<h3 class="mt-4 mb-4 font-sans">{{  $paper->title  }}'s from <a href="/school" class="no-underline text-blue roman">{{  $paper->school->name }}</a>
	</h3>
	<article class="article-feeds mb-4">	
		<div class="flex ml-4" id="papersInformation">	
			<div class="flex-1">
			<a href="#" class="text-blue-dark no-underline"><h3 class="mt-4 font-basic text-2xl font-black">{{  $paper->title  }} by {{   $paper->publisher->full_name }}
				</h3>
			</a>
			<p class="mt-4 mb-2 text-normal font-bold font-sans">{{  $paper->research_description }}</em></p>
			{{  $paper->abstract }}
{{-- 
<input readonly="true" id="abstract" value="{{  $paper->abstract }}" type="hidden" name="abstract">
<h3 class="mt-6 text-2xl font-semibold text-normal mb-2">Abstract</h3>
<trix-editor input="abstract"></trix-editor> --}}
{{-- <trix-editor class="trix-content"></trix-editor> --}}
{{-- <div class="trix-content">{{  $paper->abstract }}</div> --}}


{{-- <p class="mt-2 text-normal font-medium font-sans">{{ $paper->abstract }}</em></p> --}}

</div>
</div>

<hr class="h-mm bg-grey-lighter ">

<section class="flex mt-2" id="userInteractions">

	<a href="#" id="followPaper">
		<svg class="fill-current text-grey-darkest h-8 w-8 ml-4 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M569.354 231.631C512.969 135.949 407.81 72 288 72 168.14 72 63.004 135.994 6.646 231.631a47.999 47.999 0 0 0 0 48.739C63.031 376.051 168.19 440 288 440c119.86 0 224.996-63.994 281.354-159.631a47.997 47.997 0 0 0 0-48.738zM288 392c-75.162 0-136-60.827-136-136 0-75.162 60.826-136 136-136 75.162 0 136 60.826 136 136 0 75.162-60.826 136-136 136zm104-136c0 57.438-46.562 104-104 104s-104-46.562-104-104c0-17.708 4.431-34.379 12.236-48.973l-.001.032c0 23.651 19.173 42.823 42.824 42.823s42.824-19.173 42.824-42.823c0-23.651-19.173-42.824-42.824-42.824l-.032.001C253.621 156.431 270.292 152 288 152c57.438 0 104 46.562 104 104z"/>
		</svg>
	</a>

	<p class="text-normal mt-3 ml-2 font-normal font-display mr-2">Follow</p> 

	<em id="followerCount" class="font-display font-bold roman mr-2">{{ $paper->followersCount }}</em>

	<a href="#" id="likeButton">
		<svg class="fill-current text-grey-darkest h-8 w-8 ml-4 mt-2"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 3.22l-.61-.6a5.5 5.5 0 0 0-7.78 7.77L10 18.78l8.39-8.4a5.5 5.5 0 0 0-7.78-7.77l-.61.61z"/>
		</svg>
	</a>

	<p class="text-normal mt-3 ml-2 font-normal font-display mr-2" id="likeText">Like</p>

	<em class="font-bold roman likesCount">
		{{  $paper->likeCount }}
	</em>

	@if (!auth()->user()->isStudent())

	<a href="#" id="requestToCollaborate">
		<svg class="fill-current text-grey-darkest h-8 w-8 ml-4 mt-2"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M488 192H336v56c0 39.7-32.3 72-72 72s-72-32.3-72-72V126.4l-64.9 39C107.8 176.9 96 197.8 96 220.2v47.3l-80 46.2C.7 322.5-4.6 342.1 4.3 357.4l80 138.6c8.8 15.3 28.4 20.5 43.7 11.7L231.4 448H368c35.3 0 64-28.7 64-64h16c17.7 0 32-14.3 32-32v-64h8c13.3 0 24-10.7 24-24v-48c0-13.3-10.7-24-24-24zm147.7-37.4L555.7 16C546.9.7 527.3-4.5 512 4.3L408.6 64H306.4c-12 0-23.7 3.4-33.9 9.7L239 94.6c-9.4 5.8-15 16.1-15 27.1V248c0 22.1 17.9 40 40 40s40-17.9 40-40v-88h184c30.9 0 56 25.1 56 56v28.5l80-46.2c15.3-8.9 20.5-28.4 11.7-43.7z"/>
		</svg>
	</a>

	<p id="requestCollaborateStatus" class="text-normal mt-3 ml-2 font-normal font-display font-bold ">Request to Collaborate
	</p>

	<a href="#" id="recommendToPaper">
		<svg class="fill-current text-grey-darkest h-8 w-8 ml-4 mt-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M43.246 466.142c-58.43-60.289-57.341-157.511 1.386-217.581L254.392 34c44.316-45.332 116.351-45.336 160.671 0 43.89 44.894 43.943 117.329 0 162.276L232.214 383.128c-29.855 30.537-78.633 30.111-107.982-.998-28.275-29.97-27.368-77.473 1.452-106.953l143.743-146.835c6.182-6.314 16.312-6.422 22.626-.241l22.861 22.379c6.315 6.182 6.422 16.312.241 22.626L171.427 319.927c-4.932 5.045-5.236 13.428-.648 18.292 4.372 4.634 11.245 4.711 15.688.165l182.849-186.851c19.613-20.062 19.613-52.725-.011-72.798-19.189-19.627-49.957-19.637-69.154 0L90.39 293.295c-34.763 35.56-35.299 93.12-1.191 128.313 34.01 35.093 88.985 35.137 123.058.286l172.06-175.999c6.177-6.319 16.307-6.433 22.626-.256l22.877 22.364c6.319 6.177 6.434 16.307.256 22.626l-172.06 175.998c-59.576 60.938-155.943 60.216-214.77-.485z"/></svg>
	</a>
	<p class="text-normal mt-3 ml-2 font-normal font-display font-bold" id="recommendStatus">Recommend
	</p>

	@endif

</section>

</article>


@if(!auth()->user()->isStudent())

<form style="display:none" name="recommendPaperModal" id="recommendPaperModal" class="bg-white w-full">
	<div class="ml-1">

		<h3 class="text-2xl">Recommend Form</h3>

		<div class="mb-4 pt-4">
			<label class="font-sans block text-grey-darker text-sm font-bold mb-2" for="username">
				Display Name
			</label>
			<input value="{{  auth()->user()->full_name }}" name="display_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="display_name" type="text" placeholder="Username">
		</div>

		<div class="mb-4 pt-4">
			<label class="font-sans block text-grey-darker text-sm font-bold mb-2" for="username">
				Your Recommendation
			</label>
			<input id="recommendation" class="recommendation" type="hidden" name="recommendation">
			<trix-editor input="recommendation" class="appearance-none block w-full bg-grey-lightest text-grey-darker border border-grey rounded p-2 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" input="recommendation">
			</trix-editor>
		</div>

		<div class="flex flex-wrap mb-1">
			<div class="w-full md:w-full">
				<button type="submit" class="bg-green-dark py-3 px-8 w-full text-white font-bold">Submit my recommendation</button>
			</div>
		</div>
	</div>
</div>
</div>	
</form>

<form style="display:none" name="requestCollaborationModal" id="requestCollaborationModal" class="bg-white p-4">
	<h3>Request for a collaboration</h3>

	<hr class="h-mm bg-grey-light mt-2">
	<div class="mt-2 pt-4">
		<label class="font-sans block text-grey-darker text-sm font-bold mb-2" for="username">
			Add a Note
		</label>
		<input id="note" type="hidden" name="note">
		<trix-editor input="note" class="appearance-none block w-full bg-grey-lightest text-grey-darker border border-grey rounded p-2 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" input="recommendation">
		</trix-editeor>
	</div>

	<div class="flex flex-wrap mb-1">
		<div class="w-full md:w-full">
			<button class="bg-green-dark py-3 px-8 w-full text-white font-bold">Submit my Collaboration Request</button>
		</div>
	</div>
</form>

@endif

@foreach ($paper->photos as $photo)

<img class="h-4 w-4" src="{{ asset('app/public/papers/photos/'.$photo->image_file ) }}" alt="">

@endforeach


</div>


@endsection

@section('scripts')
<script src="{{ asset('js/jquery-modal.min.js') }}"></script>

<script>

	$(() => {
// $('#recommendPaperModal').hide();
// $('#requestCollaborationModal').hide();

const paper = '{{  $paper->id }}' ;

const paperAbstract = '{{  $paper->abstract }}' ;

const userId = window.App.user.id ;

let uriForCheckingUsersLikedPapers = '{{ route('api.papers.user.liked',  $paper->id ) }}';
let uriForActivityCheck = '{{ route('api.papers.user.activity',  $paper->id ) }}';
let uriForActivity  = '{{ route('papers.activity', $paper->id) }}';


const activityIdRecommend = 1  ;
const activityIdCollaborate = 2  ;
const activityIdLike = 3 ;	
const activityIdFollow = 4 ;

// initialize this while loading the page.
checkIfUserHasLikedThePaper(paper,uriForCheckingUsersLikedPapers,userId);
checkIfUserHasRequestedCollaboration(paper,uriForActivityCheck,userId, activityIdCollaborate);
checkIfUserHasRecommended(paper,uriForActivityCheck,userId, activityIdRecommend);

abstractIsHTML(paperAbstract);
// return isHTML("<div>p</div>")

function abstractIsHTML(paperAbstract) {
// console.log(paperAbstract);

let isHTML = RegExp.prototype.test.bind(/(<([^>]+)>)/i);

console.log(isHTML(paperAbstract));
}


$('form#recommendPaperModal').on($.modal.CLOSE, function(event, modal) {
	$(this).trigger('reset');
});


$('form#requestCollaborationModal').on($.modal.CLOSE, function(event, modal) {
	$(this).trigger('reset');	
	$('p#requestCollaborateStatus').text("Requested for Collaboration").addClass("text-red");
});



$("form#recommendPaperModal").on("submit",function (evt){

	evt.preventDefault();

	let displayName = $("#display_name").val();

	let recommendation = $("#recommendation").val() ;

	console.log(formData); 

	if ( displayName === '' || recommendation === ''){
		alert("Please fill the fields properly..");
	}
	else { 
// var formData = $(this).serializeArray();
var formData = $(this).serializeArray();
startActivity(formData, activityIdRecommend);
}	
});


$("form#requestCollaborationModal").on("submit",function (evt){
	evt.preventDefault();

	let displayName = $("#display_name").val(); 
	let recommendation = $("#note").val() ;

	console.log(displayName); 

	console.log(recommendation); 

	if ( displayName === '' || recommendation === ''){
		alert("Please fill the fields properly..");
	}
	else { 
		var formData = $(this).serializeArray();
		startActivity(formData, activityIdCollaborate);
	}	

});

/*this is the interactios..*/
$("#userInteractions > a ").on("click",function (x){
// let action = $(this);
// get the id  of the action if it's a#likeButton get the likeButton

let id = $(this).attr('id');

let ModalEffect = {
	fadeDuration: 100,
	fadeDelay: 0.05
};

// console.log(id);

if (id === "followPaper"){
	followPaper(paper,activityIdFollow);
}

else if (id === "likeButton") {
	likePaper(paper,userId,activityIdLike); 			
}	

else if (id === "requestToCollaborate" ) {

// show the collaboration modal which has the following -> a little note and a submit button..
$("#requestCollaborationModal").modal(ModalEffect) ;
// add this if you really successfully requested..

// startActivity(paper,activityIdollaborate); 			
}

else if (id === "recommendToPaper") {
// show some request.. 

$("#recommendPaperModal").modal(ModalEffect);

// startActivity(paper,activityIdLike); 			
}
});
});




	function checkIfUserHasLikedThePaper(paperId,uri,userId) {
		let uriForLikingthePapers = uri ; 

		$.ajax({
			method : 'GET' ,
			url : uriForLikingthePapers ,
			data : { 
				userId, 
				paperId,
			}, 
		}).done(function(data, status ,xhr) {
			if ( data == 1){
// alert("add the like class");
$("a#likeButton > svg").removeClass('text-grey-darkest').addClass("text-red");	
$("#likeText").text("Liked");
}
else { 
	$("a#likeButton > svg").removeClass('text-red').addClass("text-grey-darkest");	
	$("#likeText").text("Like");
}
}).fail(function (xhr,textStatus){
	if ( xhr.status === 500){
		console.log("It's not allowed sir");
	}
	else if ( xhr.status == 403){
		alert(xhr.responseText);
	}
}); 

}


function followPaper(paperId, userId, activityId) {
	// let paperLikesCount = '{{ $paper->likeCount }}' ;
	let likePaperUrl = '{{ route('papers.like',$paper->id) }}';

	$.ajax({
		method : 'POST' ,
		url : likePaperUrl ,
		data : { 
			userId, 
			paperId,
			activityId
		}, 
	})
	.done(function(data, status ,xhr) {
		console.log("Data.."+data);
/*
if ( data.likeStatus == 1 ){
	$("em.likesCount").text(data.likesCount);
	$("#likeText").text("Liked");
	$("a#likeButton > svg").removeClass('text-grey-darkest').addClass("text-red");	
}*/


/*

else {
// let newLikeCount = paperLikesCount + 1  ;
$("em.likesCount").text(data.unlikeCount);
$("#likeText").text("Like");
$("a#likeButton > svg").removeClass('text-red').addClass("text-grey-darkest");	
}*/

if ( data == 0 ) { 
	console.log("Data attached:"+data.attached);
	// issue a liked
	$("em.likesCount").text(data.likesCount);
	$("#likeText").text("Like").removeClass('font-bold');
	$("a#likeButton > svg").removeClass('text-red').addClass("text-grey-darkest");	

} 
else {

	$("em.likesCount").text(data.likesCount);

	$("#likeText").text("Liked").addClass("font-bold");

	$("a#likeButton > svg").removeClass('text-grey-darkest').addClass("text-red");	

	console.log(data);
}


}).fail(function (data,xhr,textStatus){
	if ( xhr.status = 500){
		console.log("There's an error");
	}
	if ( xhr.status = 403){
		var dataStats = data.status ; 
		Swal('403',data.statusText,'warning');
		console.log(data);
	}
}); 


}


function likePaper(paperId,userId,activityId) {
	// let paperLikesCount = '{{ $paper->likesCount }}' ;
	let likePaperUrl = '{{ route('papers.like', $paper->id) }}';

	$.ajax({
		method : 'POST' ,
		url : likePaperUrl ,
		data : { 
			userId, 
			paperId,
			activityId
		}, 
	})
	.done(function(data, status ,xhr) {
		console.log("Data.."+data);
/*
if ( data.likeStatus == 1 ){
	$("em.likesCount").text(data.likesCount);
	$("#likeText").text("Liked");
	$("a#likeButton > svg").removeClass('text-grey-darkest').addClass("text-red");	
}*/


/*

else {
// let newLikeCount = paperLikesCount + 1  ;
$("em.likesCount").text(data.unlikeCount);
$("#likeText").text("Like");
$("a#likeButton > svg").removeClass('text-red').addClass("text-grey-darkest");	
}*/

if ( data == 0 ) { 
	console.log("Data attached:"+data.attached);
	// issue a liked
	$("em.likesCount").text(data.likesCount);
	$("#likeText").text("Like").removeClass('font-bold');
	$("a#likeButton > svg").removeClass('text-red').addClass("text-grey-darkest");	

} 
else {
	$("em.likesCount").text(data.likesCount);
	$("#likeText").text("Liked").addClass("font-bold");
	$("a#likeButton > svg").removeClass('text-grey-darkest').addClass("text-red");	
	console.log(data);
}
}).fail(function (data,xhr,textStatus){
	if ( xhr.status = 500){
		console.log("There's an error");
	}
	if ( xhr.status = 403){
		var dataStats = data.status ; 
		Swal('403',data.statusText,'warning');
		console.log(data);
	}
}); 

}


function startActivity(requestData,activityId){

	let uri = '{{ route('papers.activity', $paper->id) }}';	

	$.ajax({

		method : 'POST' ,
		url : uri ,
		data : {
			requestData, 
			activityId
		},
		success : function(data) {
			console.log(data);
			$.modal.close();

			/*if collaboration*/
			if ( data.activity_id == 2){
				Swal('Success', data.message, 'success');
				$('#requestToCollaborate > svg').removeClass("text-black").addClass("text-blue-light");
				$('#requestCollaborateStatus'),text('Requested for Collaboration');
			}
			/*if recommendation*/

			else if (data.activity_id == 1){
				Swal('Success', data.message, 'success');
				$('#requestToCollaborate > svg').removeClass("text-black").addClass("text-blue-light");
				$('#requestCollaborateStatus').text('Requested for Collaboration');
			}

		},
		error : function (data, xhr,textStatus) {
			if ( data.status === 500) {
// /alert("Internal Server Error");
Swal('500', 'Internal Server Error', 'error');
}

else if ( data.status === 403){
// console.log(data);
let message = data.responseJSON.message ;
Swal('Forbidden', message, 'error');
$.modal.close();
}
}


});


}

function checkIfUserHasRequestedCollaboration(paper,uri,userId,activityId){
	console.log(uri);
	$.ajax({
		method : 'GET' ,
		url : uri ,
		data : {  
			activityId
		}, 
	}).done(function(data, status ,xhr) {
		if ( data >= 1){
			$("a#requestToCollaborate > svg").removeClass('text-grey-darkest').addClass("text-green");	
			$("#requestCollaborateStatus").text("Requested for Collaboration");
		}
		console.log(data);
	}).fail(function (xhr,textStatus){
		console.log(xhr);
	}); 
}

function checkIfUserHasRecommended(paper,uri,userId, activityId){

	$.ajax({
		method : 'GET' ,
		url : uri ,
		data : { 
			activityId
		}, 
	}).done(function(data, status ,xhr) {
		if ( data >= 1) {
// alert("add the like class");
$("a#recommendToPaper > svg").removeClass('text-grey-darkest').addClass("text-blue-dark");	
$("#recommendStatus").text("Recommended");
}
else { 
	console.log("not yet recommended");
}
}).fail(function (xhr,textStatus){
	if ( xhr.status === 500){
		console.log("It's not allowed sir");
	}
	else if ( xhr.status == 403){
		alert(xhr.responseText);
	}
}); 

}


function recommendPaper(recData, uri){
	console.log(uri);

	$.ajax({
		url: uri,
		type: 'POST',
		data: { 
			data: recData 
		},
	}).done(function() {
		console.log("success");
	}).fail(function() {
		console.log("error");
	}).always(function() {
		console.log("complete");
	});

}
</script>
@endsection
