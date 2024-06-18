(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$":
/*!****************************************************************************************************************!*\
  !*** ./assets/controllers/ sync ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \.[jt]sx?$ ***!
  \****************************************************************************************************************/
/***/ ((module) => {

function webpackEmptyContext(req) {
	var e = new Error("Cannot find module '" + req + "'");
	e.code = 'MODULE_NOT_FOUND';
	throw e;
}
webpackEmptyContext.keys = () => ([]);
webpackEmptyContext.resolve = webpackEmptyContext;
webpackEmptyContext.id = "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$";
module.exports = webpackEmptyContext;

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json":
/*!************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
});

/***/ }),

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.promise.js */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _bootstrap_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./bootstrap.js */ "./assets/bootstrap.js");
/* harmony import */ var _js_test_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./js/test.js */ "./assets/js/test.js");
/* harmony import */ var _js_test_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_js_test_js__WEBPACK_IMPORTED_MODULE_3__);




/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
// import './styles/app.css';


// import { createApp } from 'vue';
// import app from './components/Hello-World.vue';

// const app = createApp({});
// app.component('hello-world', HelloWorld);

// app.mount('#app');

// const $ = require('jquery'); Par défaut
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
// require('bootstrap'); par défaut

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function () {
  $('[data-toggle="popover"]').popover();
});
// assets/app.js  
// import './styles/app.css'; // A voir plus tard
var entreeSortie = document.getElementById('entreeSortie');
loginBtn.addEventListener('click', function () {
  if (entreeSortie.textContent === 'Connexion') {
    // Rediriger vers la page de connexion
    window.location.href = '/login';
  } else {
    // Déconnecter l'utilisateur
    fetch('/logout', {
      method: 'POST'
    }).then(function () {
      // Actualiser la page après la déconnexion
      window.location.reload();
    })["catch"](function (error) {
      console.error('Error:', error);
    });
  }
});

/***/ }),

/***/ "./assets/bootstrap.js":
/*!*****************************!*\
  !*** ./assets/bootstrap.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");
// assets/bootstrap.js


// Registers Stimulus controllers from controllers.json and in the controllers/ directory
(0,_symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__.startStimulusApp)(__webpack_require__("./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$"));

// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

/***/ }),

/***/ "./assets/js/test.js":
/*!***************************!*\
  !*** ./assets/js/test.js ***!
  \***************************/
/***/ (() => {

console.log('Hello from Webpack Encore!');
document.addEventListener('DOMContentLoaded', function () {
  // Sélectionner un élément HTML avec son ID
  var titleElement = document.querySelector('#title');

  // Modifier le contenu textuel de l'élément
  titleElement.textContent = 'Nouveau titre';
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_core-js_modules_es_ob-3b2887"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7O0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7Ozs7Ozs7Ozs7Ozs7QUNSQSxpRUFBZTtBQUNmLENBQUM7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQ0R1Qjs7QUFFeEI7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDc0I7O0FBR3RCO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTs7QUFHQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUFBLENBQUMsQ0FBQ0MsUUFBUSxDQUFDLENBQUNDLEtBQUssQ0FBQyxZQUFXO0VBQ3pCRixDQUFDLENBQUMseUJBQXlCLENBQUMsQ0FBQ0csT0FBTyxDQUFDLENBQUM7QUFDMUMsQ0FBQyxDQUFDO0FBQ0Y7QUFDQTtBQUNBLElBQU1DLFlBQVksR0FBR0gsUUFBUSxDQUFDSSxjQUFjLENBQUMsY0FBYyxDQUFDO0FBRTVEQyxRQUFRLENBQUNDLGdCQUFnQixDQUFDLE9BQU8sRUFBRSxZQUFNO0VBQ3JDLElBQUlILFlBQVksQ0FBQ0ksV0FBVyxLQUFLLFdBQVcsRUFBRTtJQUMxQztJQUNBQyxNQUFNLENBQUNDLFFBQVEsQ0FBQ0MsSUFBSSxHQUFHLFFBQVE7RUFDbkMsQ0FBQyxNQUFNO0lBQ0g7SUFDQUMsS0FBSyxDQUFDLFNBQVMsRUFBRTtNQUNiQyxNQUFNLEVBQUU7SUFDWixDQUFDLENBQUMsQ0FDREMsSUFBSSxDQUFDLFlBQU07TUFDUjtNQUNBTCxNQUFNLENBQUNDLFFBQVEsQ0FBQ0ssTUFBTSxDQUFDLENBQUM7SUFDNUIsQ0FBQyxDQUFDLFNBQ0ksQ0FBQyxVQUFDQyxLQUFLLEVBQUs7TUFDZEMsT0FBTyxDQUFDRCxLQUFLLENBQUMsUUFBUSxFQUFFQSxLQUFLLENBQUM7SUFDbEMsQ0FBQyxDQUFDO0VBQ047QUFDSixDQUFDLENBQUM7Ozs7Ozs7Ozs7Ozs7QUN0REY7QUFDNEQ7O0FBRTVEO0FBQ0FFLDBFQUFnQixDQUFDQyx5SUFJaEIsQ0FBQzs7QUFFRjtBQUNBOzs7Ozs7Ozs7O0FDWEFGLE9BQU8sQ0FBQ0ksR0FBRyxDQUFDLDRCQUE0QixDQUFDO0FBQ3pDcEIsUUFBUSxDQUFDTSxnQkFBZ0IsQ0FBQyxrQkFBa0IsRUFBRSxZQUFXO0VBQ3JEO0VBQ0EsSUFBTWUsWUFBWSxHQUFHckIsUUFBUSxDQUFDc0IsYUFBYSxDQUFDLFFBQVEsQ0FBQzs7RUFFckQ7RUFDQUQsWUFBWSxDQUFDZCxXQUFXLEdBQUcsZUFBZTtBQUM5QyxDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vIFxcLltqdF1zeCIsIndlYnBhY2s6Ly8vLi9hc3NldHMvY29udHJvbGxlcnMuanNvbiIsIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9ib290c3RyYXAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL3Rlc3QuanMiXSwic291cmNlc0NvbnRlbnQiOlsiZnVuY3Rpb24gd2VicGFja0VtcHR5Q29udGV4dChyZXEpIHtcblx0dmFyIGUgPSBuZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiICsgcmVxICsgXCInXCIpO1xuXHRlLmNvZGUgPSAnTU9EVUxFX05PVF9GT1VORCc7XG5cdHRocm93IGU7XG59XG53ZWJwYWNrRW1wdHlDb250ZXh0LmtleXMgPSAoKSA9PiAoW10pO1xud2VicGFja0VtcHR5Q29udGV4dC5yZXNvbHZlID0gd2VicGFja0VtcHR5Q29udGV4dDtcbndlYnBhY2tFbXB0eUNvbnRleHQuaWQgPSBcIi4vYXNzZXRzL2NvbnRyb2xsZXJzIHN5bmMgcmVjdXJzaXZlIC4vbm9kZV9tb2R1bGVzL0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyLmpzISBcXFxcLltqdF1zeD8kXCI7XG5tb2R1bGUuZXhwb3J0cyA9IHdlYnBhY2tFbXB0eUNvbnRleHQ7IiwiZXhwb3J0IGRlZmF1bHQge1xufTsiLCJpbXBvcnQgJy4vYm9vdHN0cmFwLmpzJztcclxuXHJcbi8qXHJcbiAqIFdlbGNvbWUgdG8geW91ciBhcHAncyBtYWluIEphdmFTY3JpcHQgZmlsZSFcclxuICpcclxuICogVGhpcyBmaWxlIHdpbGwgYmUgaW5jbHVkZWQgb250byB0aGUgcGFnZSB2aWEgdGhlIGltcG9ydG1hcCgpIFR3aWcgZnVuY3Rpb24sXHJcbiAqIHdoaWNoIHNob3VsZCBhbHJlYWR5IGJlIGluIHlvdXIgYmFzZS5odG1sLnR3aWcuXHJcbiAqL1xyXG4vLyBpbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnO1xyXG5pbXBvcnQgJy4vanMvdGVzdC5qcyc7XHJcblxyXG5cclxuLy8gaW1wb3J0IHsgY3JlYXRlQXBwIH0gZnJvbSAndnVlJztcclxuLy8gaW1wb3J0IGFwcCBmcm9tICcuL2NvbXBvbmVudHMvSGVsbG8tV29ybGQudnVlJztcclxuXHJcbi8vIGNvbnN0IGFwcCA9IGNyZWF0ZUFwcCh7fSk7XHJcbi8vIGFwcC5jb21wb25lbnQoJ2hlbGxvLXdvcmxkJywgSGVsbG9Xb3JsZCk7XHJcblxyXG4vLyBhcHAubW91bnQoJyNhcHAnKTtcclxuXHJcblxyXG4vLyBjb25zdCAkID0gcmVxdWlyZSgnanF1ZXJ5Jyk7IFBhciBkw6lmYXV0XHJcbi8vIHRoaXMgXCJtb2RpZmllc1wiIHRoZSBqcXVlcnkgbW9kdWxlOiBhZGRpbmcgYmVoYXZpb3IgdG8gaXRcclxuLy8gdGhlIGJvb3RzdHJhcCBtb2R1bGUgZG9lc24ndCBleHBvcnQvcmV0dXJuIGFueXRoaW5nXHJcbi8vIHJlcXVpcmUoJ2Jvb3RzdHJhcCcpOyBwYXIgZMOpZmF1dFxyXG5cclxuLy8gb3IgeW91IGNhbiBpbmNsdWRlIHNwZWNpZmljIHBpZWNlc1xyXG4vLyByZXF1aXJlKCdib290c3RyYXAvanMvZGlzdC90b29sdGlwJyk7XHJcbi8vIHJlcXVpcmUoJ2Jvb3RzdHJhcC9qcy9kaXN0L3BvcG92ZXInKTtcclxuXHJcbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG4gICAgJCgnW2RhdGEtdG9nZ2xlPVwicG9wb3ZlclwiXScpLnBvcG92ZXIoKTtcclxufSk7XHJcbi8vIGFzc2V0cy9hcHAuanMgIFxyXG4vLyBpbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnOyAvLyBBIHZvaXIgcGx1cyB0YXJkXHJcbmNvbnN0IGVudHJlZVNvcnRpZSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdlbnRyZWVTb3J0aWUnKTtcclxuXHJcbmxvZ2luQnRuLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4ge1xyXG4gICAgaWYgKGVudHJlZVNvcnRpZS50ZXh0Q29udGVudCA9PT0gJ0Nvbm5leGlvbicpIHtcclxuICAgICAgICAvLyBSZWRpcmlnZXIgdmVycyBsYSBwYWdlIGRlIGNvbm5leGlvblxyXG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbi5ocmVmID0gJy9sb2dpbic7XHJcbiAgICB9IGVsc2Uge1xyXG4gICAgICAgIC8vIETDqWNvbm5lY3RlciBsJ3V0aWxpc2F0ZXVyXHJcbiAgICAgICAgZmV0Y2goJy9sb2dvdXQnLCB7XHJcbiAgICAgICAgICAgIG1ldGhvZDogJ1BPU1QnXHJcbiAgICAgICAgfSlcclxuICAgICAgICAudGhlbigoKSA9PiB7XHJcbiAgICAgICAgICAgIC8vIEFjdHVhbGlzZXIgbGEgcGFnZSBhcHLDqHMgbGEgZMOpY29ubmV4aW9uXHJcbiAgICAgICAgICAgIHdpbmRvdy5sb2NhdGlvbi5yZWxvYWQoKTtcclxuICAgICAgICB9KVxyXG4gICAgICAgIC5jYXRjaCgoZXJyb3IpID0+IHtcclxuICAgICAgICAgICAgY29uc29sZS5lcnJvcignRXJyb3I6JywgZXJyb3IpO1xyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG59KTtcclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuIiwiLy8gYXNzZXRzL2Jvb3RzdHJhcC5qc1xuaW1wb3J0IHsgc3RhcnRTdGltdWx1c0FwcCB9IGZyb20gJ0BzeW1mb255L3N0aW11bHVzLWJyaWRnZSc7XG5cbi8vIFJlZ2lzdGVycyBTdGltdWx1cyBjb250cm9sbGVycyBmcm9tIGNvbnRyb2xsZXJzLmpzb24gYW5kIGluIHRoZSBjb250cm9sbGVycy8gZGlyZWN0b3J5XG5zdGFydFN0aW11bHVzQXBwKHJlcXVpcmUuY29udGV4dChcbiAgICAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIhLi9jb250cm9sbGVycycsXG4gICAgdHJ1ZSxcbiAgICAvXFwuW2p0XXN4PyQvXG4pKTtcblxuLy8gcmVnaXN0ZXIgYW55IGN1c3RvbSwgM3JkIHBhcnR5IGNvbnRyb2xsZXJzIGhlcmVcbi8vIGFwcC5yZWdpc3Rlcignc29tZV9jb250cm9sbGVyX25hbWUnLCBTb21lSW1wb3J0ZWRDb250cm9sbGVyKTtcbiIsImNvbnNvbGUubG9nKCdIZWxsbyBmcm9tIFdlYnBhY2sgRW5jb3JlIScpO1xyXG5kb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCdET01Db250ZW50TG9hZGVkJywgZnVuY3Rpb24oKSB7XHJcbiAgICAvLyBTw6lsZWN0aW9ubmVyIHVuIMOpbMOpbWVudCBIVE1MIGF2ZWMgc29uIElEXHJcbiAgICBjb25zdCB0aXRsZUVsZW1lbnQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjdGl0bGUnKTtcclxuXHJcbiAgICAvLyBNb2RpZmllciBsZSBjb250ZW51IHRleHR1ZWwgZGUgbCfDqWzDqW1lbnRcclxuICAgIHRpdGxlRWxlbWVudC50ZXh0Q29udGVudCA9ICdOb3V2ZWF1IHRpdHJlJztcclxufSk7Il0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5IiwicG9wb3ZlciIsImVudHJlZVNvcnRpZSIsImdldEVsZW1lbnRCeUlkIiwibG9naW5CdG4iLCJhZGRFdmVudExpc3RlbmVyIiwidGV4dENvbnRlbnQiLCJ3aW5kb3ciLCJsb2NhdGlvbiIsImhyZWYiLCJmZXRjaCIsIm1ldGhvZCIsInRoZW4iLCJyZWxvYWQiLCJlcnJvciIsImNvbnNvbGUiLCJzdGFydFN0aW11bHVzQXBwIiwicmVxdWlyZSIsImNvbnRleHQiLCJsb2ciLCJ0aXRsZUVsZW1lbnQiLCJxdWVyeVNlbGVjdG9yIl0sInNvdXJjZVJvb3QiOiIifQ==