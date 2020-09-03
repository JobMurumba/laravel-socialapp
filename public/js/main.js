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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/main.js":
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $('.select2-class').select2();
  $('.like').click(function (e) {
    e.preventDefault();
    var like = e.target.previousElementSibling == null;
    var post_id = e.target.parentNode.dataset['postid'];
    console.log(post_id);
    var data = {
      isLike: like,
      post_id: post_id
    };
    axios.post('/like', data).then(function (response) {
      // console.log(response)
      $("[data-postid='" + response['data']['post_id'] + "'] >.active-like").attr('class', 'btn btn-link like');
      e.currentTarget.className = 'btn btn-link like active-like';
    });
  });
  $('.friend').click(function (e) {
    e.preventDefault();
    var friendid = e.target.parentNode.dataset['friendid'];
    var data = {
      friendid: friendid
    };
    axios.post('/friend', data).then(function (response) {
      //console.log(response)
      //$("[data-friend='" + response['data']['post_id']+"'] >.active-like").attr('class','btn btn-link like');
      e.currentTarget.className = 'btn btn-link remove-friend';
      e.target.innerHTML = "Remove friend";
    });
  });
  $('.remove-friend').click(function (e) {
    e.preventDefault();
    var friendid = e.target.parentNode.dataset['friendid'];
    var data = {
      friendid: friendid
    };
    axios.post('/friend/remove', data).then(function (response) {
      //console.log(response)
      //$("[data-friend='" + response['data']['post_id']+"'] >.active-like").attr('class','btn btn-link like');
      e.currentTarget.className = 'btn btn-link friend';
      e.target.innerHTML = "Add friend";
    });
  });
  $('.request').click(function (e) {
    e.preventDefault();
    var request = e.target.previousElementSibling == null;
    var user_id = e.target.parentNode.dataset['userid'];
    console.log(user_id);
    var data = {
      isRequest: request,
      user_id: user_id
    };
    axios.post('/request', data).then(function (response) {
      // console.log(response)
      if (response.data['true']) {
        e.currentTarget.parentElement.innerHTML = "<span class='success'>You are now friends</span>";
      } else {
        e.currentTarget.parentElement.innerHTML = "<span class='danger'>You canceled the friend request</span>";
      }

      $("[data-postid='" + response['data']['post_id'] + "'] >.active-like").attr('class', 'btn btn-link like');
      e.currentTarget.className = 'btn btn-link like active-like';
    });
  });
});

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/main.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/jobmurumba/Documents/social_laravel/socialmedia/resources/js/main.js */"./resources/js/main.js");


/***/ })

/******/ });