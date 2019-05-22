/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(3);


/***/ }),
/* 1 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__env_js__ = __webpack_require__(2);
/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/
// window.Vue = require('vue');

// import $ from 'jquery';

// import scripts from './scripts.js';

$(function () {

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).ready(function () {
		$('meta[name="viewport"]').prop('content', 'width=1440');
	});

	$("#flashMessage").delay(2000).fadeOut(100);

	$("#registerForm").hide();

	// when you click on the dropdown chevron..
	$(".dropDownNav").on("click", function () {
		$(".navMenu").toggle();
	});

	/*Hiding the panel on login & registration*/

	$(".register-button").on("click", function () {
		$("#registerForm").show();
		$("#loginForm").hide();
	});

	$(".login-button").on("click", function () {
		$("#registerForm").hide();
		$("#loginForm").show();
	});

	$("#closeButton").on("click", function () {
		$("#flashMessage").hide();
	});

	$("form#createPapers").on("submit", function (evt) {
		evt.preventDefault();

		// var data = $(this).serializeArray();
		var data = new FormData($("#createPapers")[0]);

		var urlStorePapers = __WEBPACK_IMPORTED_MODULE_0__env_js__["a" /* default */].storePapersUrl;

		console.log("Data included are " + data);

		$.ajax({
			url: urlStorePapers,
			type: 'POST',
			data: data,
			cache: false,
			contentType: false,
			processData: false
		}).done(function (data, status, xhr) {

			if (xhr.status === 201) {
				alert(data.Data);
				document.location.replace('/papers/' + data.Paper.id);
			} else if (xhr.status === 500) {
				Swal(data, "500", "Internal Error");
			} else if (xhr.status == 422) {
				alert("There are incomplete fields");
			}
		}).fail(function (xhr, textStatus) {
			if (xhr.statusCode == 422) {
				Swal(data, "422", "There was an error processing your request consider checking your inputs");
				document.location.replace('/papers/create');
			}
		});

		/*		We have the user function.. here
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

	for (var c = a.childNodes, i = c.length; i--;) {
		if (c[i].nodeType == 1) return true;
	}

	return false;
}

function function_name(argument) {
	$('#play-pause').click(function () {
		if ($('#video-over').css('visibility') == 'hidden') $('#video-over').css('visibility', 'visible');else $('#video-over').css('visibility', 'hidden');
	});
}

/***/ }),
/* 2 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
var user = window.App.user;
var storePapersUrl = window.App.storePapers;

/* harmony default export */ __webpack_exports__["a"] = ({
	user: user,
	storePapersUrl: storePapersUrl
});

/***/ }),
/* 3 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);