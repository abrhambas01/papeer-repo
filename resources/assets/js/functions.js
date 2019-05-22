function checkIfUserHasLikedThePaper(paperId) {
	console.log("checkIfUserHasLikedThePaper starts");
}
	

function likePaper(paperId,userId) {
	let paperLikesCount = {{ $paper->likesCount }} ;

	let likePaperUrl = '{{ route('papers.like',$paper->id) }}';

	$.ajax({
		method : 'POST' ,
		url : likePaperUrl ,
		data : { 
			userId, 
			paperId
		}, 
	}).done(function(data, status ,xhr) {
		// console.log("XHR : " +xhr);
		console.log(data);
		if ( data === 0 ){
			$("a#likeButton > svg").removeClass('text-red').addClass("text-grey-darkest");
		}
		else {

			$("a#likeButton > svg").removeClass('text-grey-darkest').addClass("text-red");	
		}
	})
	.fail(function (xhr,textStatus){
		if ( xhr.status === 500){
			console.log("It's not allowed sir");
		}
	});

}

function recommendPaper(recData){
	console.log(recData);
}

function startActivity(...data){
	let response = data ; 
	// console.log(data);
	let uri = '{{ route('papers.activity', $paper->id) }}';

	$.ajax({
		method : 'POST' ,
		url : uri ,
		data : data, 
	})
	.done(function(data, status ,xhr) {
		console.log("XHR" +xhr);
		// alert(status);
	})
	.fail(function (xhr,textStatus){
		if ( xhr.status === 500){
			console.log("It's not allowed sir");
		}
	});
}