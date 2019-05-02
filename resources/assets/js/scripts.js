// refer the papers.show. file..
// not needed anymore..
$(document).ready(function(){
	const paperId = '{{  $paper->id }}' ; 

	$("#followButton").on("click",function(){
		follow(paperId);
	});

	$("#likeButton").on("click",function(){
		likePaper(paperId);			
	});

	$("#requestToCollaborate").on("click",function(){
		requestToCollaborate(paperId);
	});

	$("#recommend").on("click",function(){
		recommend(paperId);
	});

	$("#followPaper").on("click",function(){
		startActivity(paper,activityIdFollow);
	});

		// $('a[href^="#"][href*="henry"]').addClass('henrylink');


		$("#likeButton").on("click",function(){
			startActivity(paper,activityIdLike); 			
		});


		$("#requestToCollaborate").on("click",function(){

			$(".requestCollaboration").modal() ;

			// startActivity(paper,activityIdCollaborate);
		});


		$("#recommend").on("click",function(){
			// show the recommend modal first
			$('#recommendModal').modal();

			// startActivity(paper,activityIdRecommend);
		});

});

function requestToCollaborate(paperId) {

	let userId = window.App.user.id ; 
	
	let uri = '{{ route('request.paper', $paper->id) }}';


	$.ajax({
		method : 'POST' ,
		url : uri ,
		data : { 
			userId : userId ,
			paperId : paperId 
		},
		success : function (data){
			console.log(data);
		},
		error : function (xhr,res) {
			console.log(xhr);
		}
	})

}

function recommend(paperId) {

	let userId = window.App.user.id ; 
	let activityId = 1 ; 
	let uri = '{{ route('request.paper', $paper->id) }}';


	$.ajax({
		method : 'POST' ,
		url : uri ,
		data : { 
			userId : userId ,
			activityId : 1  , 
			paperId : paperId 
		},
		success : function (data){
			console.log(data);
		},
		error : function (xhr,res) {
			console.log(xhr);
		}
	})

}


function likePaper(paperId) {

	let userId = window.App.user.id ; 
	let activityId = 1 ; 
	let uri = '{{ route('request.paper', $paper->id) }}';


	$.ajax({
		method : 'POST' ,
		url : uri ,
		data : { 
			userId : userId ,
			activityId : 1  , 
			paperId : paperId 
		},
		success : function (data){
			console.log(data);
		},
		error : function (xhr,res) {
			console.log(xhr);
		}
	})

}



function likePaper(paper,activityId) {
	console.log(paper);
}

function activateActivity(paper,activityId) {
	
	

	console.log(paper);

}


function followPaper(paper) {
	$.ajax({
		method : 'POST',
		url : uri ,
		data : data, 
	})
	.done(function(data){

	})
	.fail(function(xhr){
		
	})

}

function requestToCollaborate(paperId,activityId) {

	let userId = window.App.user.id ; 

	let uri = '{{ route('papers.activity', $paper->id) }}';

	$.ajax({
		method : 'POST' ,
		url : uri ,
		data : { 
			activityId : activityId , 
			userId : userId ,
			paperId : paperId 
		},
		success : function (data){
			console.log(data);
		},
		error : function (xhr,res) {
			console.log(xhr.status);
		}
	});

}


export default  { 
	requestToCollaborate,
	recommend,
	likePaper
}

