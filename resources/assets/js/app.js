/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/
// window.Vue = require('vue');

// import $ from 'jquery';
import uri from './env.js';
// import scripts from './scripts.js';

$(function() {

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});



	$(document).ready(function(){
		$('meta[name="viewport"]').prop('content', 'width=1440');
	});

	$("#flashMessage").delay(2000).fadeOut(100);

	$("#registerForm").hide();

	// when you click on the dropdown chevron..
	$(".dropDownNav").on("click",function(){
		$(".navMenu").toggle();
	});

	
	/*Hiding the panel on login & registration*/

	$(".register-button").on("click",function (){
		$("#registerForm").show();
		$("#loginForm").hide();
	})	;

	$(".login-button").on("click",function (){
		$("#registerForm").hide();
		$("#loginForm").show();
	})	;	

	$("#closeButton").on("click",function (){
		$("#flashMessage").hide();
	})	;


	$("form#createPapers").on("submit",function(evt){
		evt.preventDefault();

		// var data = $(this).serializeArray();
		var data = new FormData($("#createPapers")[0]);
		
		var urlStorePapers  = uri.storePapersUrl;

		console.log("Data included are " +data);

		$.ajax({
			url: urlStorePapers,
			type: 'POST',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
		}).done(function(data, status ,xhr) {
			// console.log("XHR" +data);
			console.log("Data"+data);
			console.log("status"+status);
		}).fail(function (xhr,textStatus){
			// Swal(textStatus,xhr.responseJSON.message,'warning');
			alert(xhr.responseJSON.message);
			// Swal(xhr.responseJSON.message);
			document.location.replace('/papers');
			console.log("Request failed:" +textStatus );
		});

		



/*		We have the user functoin here
		function err(xhr, reason, ex) {
			if (xhr.status = 500) {
				alert("500 Error");
			} else if (xhr.status = 422) {
				console.log("422");
			}
			else if (xhr.status = 403) {
				alert('403');
			}
		}

*/		
	});

});


function isHTML(str) {
	var a = document.createElement('div');
	a.innerHTML = str;

	for (var c = a.childNodes, i = c.length; i--; ) {
		if (c[i].nodeType == 1) return true; 
	}

	return false;
}

function function_name(argument) {
	$('#play-pause').click(function(){
		if ( $('#video-over').css('visibility') == 'hidden' )
			$('#video-over').css('visibility','visible');
		else
			$('#video-over').css('visibility','hidden');
	});

}