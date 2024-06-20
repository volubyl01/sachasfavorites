(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

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
(0,_symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__.startStimulusApp)(Object(function webpackMissingModule() { var e = new Error("Cannot find module 'undefined'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()));

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
/******/ __webpack_require__.O(0, ["vendors-node_modules_symfony_stimulus-bridge_dist_index_js","vendors-node_modules_core-js_modules_es_object_to-string_js-node_modules_core-js_modules_es_p-2a1352"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBd0I7O0FBRXhCO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ3NCOztBQUd0QjtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7O0FBR0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOztBQUVBQSxDQUFDLENBQUNDLFFBQVEsQ0FBQyxDQUFDQyxLQUFLLENBQUMsWUFBVztFQUN6QkYsQ0FBQyxDQUFDLHlCQUF5QixDQUFDLENBQUNHLE9BQU8sQ0FBQyxDQUFDO0FBQzFDLENBQUMsQ0FBQztBQUNGO0FBQ0E7QUFDQSxJQUFNQyxZQUFZLEdBQUdILFFBQVEsQ0FBQ0ksY0FBYyxDQUFDLGNBQWMsQ0FBQztBQUU1REMsUUFBUSxDQUFDQyxnQkFBZ0IsQ0FBQyxPQUFPLEVBQUUsWUFBTTtFQUNyQyxJQUFJSCxZQUFZLENBQUNJLFdBQVcsS0FBSyxXQUFXLEVBQUU7SUFDMUM7SUFDQUMsTUFBTSxDQUFDQyxRQUFRLENBQUNDLElBQUksR0FBRyxRQUFRO0VBQ25DLENBQUMsTUFBTTtJQUNIO0lBQ0FDLEtBQUssQ0FBQyxTQUFTLEVBQUU7TUFDYkMsTUFBTSxFQUFFO0lBQ1osQ0FBQyxDQUFDLENBQ0RDLElBQUksQ0FBQyxZQUFNO01BQ1I7TUFDQUwsTUFBTSxDQUFDQyxRQUFRLENBQUNLLE1BQU0sQ0FBQyxDQUFDO0lBQzVCLENBQUMsQ0FBQyxTQUNJLENBQUMsVUFBQ0MsS0FBSyxFQUFLO01BQ2RDLE9BQU8sQ0FBQ0QsS0FBSyxDQUFDLFFBQVEsRUFBRUEsS0FBSyxDQUFDO0lBQ2xDLENBQUMsQ0FBQztFQUNOO0FBQ0osQ0FBQyxDQUFDOzs7Ozs7Ozs7Ozs7O0FDdERGO0FBQzREOztBQUU1RDtBQUNBRSwwRUFBZ0IsQ0FBQ0Msd0lBSWhCLENBQUM7O0FBRUY7QUFDQTs7Ozs7Ozs7OztBQ1hBRixPQUFPLENBQUNJLEdBQUcsQ0FBQyw0QkFBNEIsQ0FBQztBQUN6Q3BCLFFBQVEsQ0FBQ00sZ0JBQWdCLENBQUMsa0JBQWtCLEVBQUUsWUFBVztFQUNyRDtFQUNBLElBQU1lLFlBQVksR0FBR3JCLFFBQVEsQ0FBQ3NCLGFBQWEsQ0FBQyxRQUFRLENBQUM7O0VBRXJEO0VBQ0FELFlBQVksQ0FBQ2QsV0FBVyxHQUFHLGVBQWU7QUFDOUMsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvYm9vdHN0cmFwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy90ZXN0LmpzIl0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCAnLi9ib290c3RyYXAuanMnO1xyXG5cclxuLypcclxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxyXG4gKlxyXG4gKiBUaGlzIGZpbGUgd2lsbCBiZSBpbmNsdWRlZCBvbnRvIHRoZSBwYWdlIHZpYSB0aGUgaW1wb3J0bWFwKCkgVHdpZyBmdW5jdGlvbixcclxuICogd2hpY2ggc2hvdWxkIGFscmVhZHkgYmUgaW4geW91ciBiYXNlLmh0bWwudHdpZy5cclxuICovXHJcbi8vIGltcG9ydCAnLi9zdHlsZXMvYXBwLmNzcyc7XHJcbmltcG9ydCAnLi9qcy90ZXN0LmpzJztcclxuXHJcblxyXG4vLyBpbXBvcnQgeyBjcmVhdGVBcHAgfSBmcm9tICd2dWUnO1xyXG4vLyBpbXBvcnQgYXBwIGZyb20gJy4vY29tcG9uZW50cy9IZWxsby1Xb3JsZC52dWUnO1xyXG5cclxuLy8gY29uc3QgYXBwID0gY3JlYXRlQXBwKHt9KTtcclxuLy8gYXBwLmNvbXBvbmVudCgnaGVsbG8td29ybGQnLCBIZWxsb1dvcmxkKTtcclxuXHJcbi8vIGFwcC5tb3VudCgnI2FwcCcpO1xyXG5cclxuXHJcbi8vIGNvbnN0ICQgPSByZXF1aXJlKCdqcXVlcnknKTsgUGFyIGTDqWZhdXRcclxuLy8gdGhpcyBcIm1vZGlmaWVzXCIgdGhlIGpxdWVyeSBtb2R1bGU6IGFkZGluZyBiZWhhdmlvciB0byBpdFxyXG4vLyB0aGUgYm9vdHN0cmFwIG1vZHVsZSBkb2Vzbid0IGV4cG9ydC9yZXR1cm4gYW55dGhpbmdcclxuLy8gcmVxdWlyZSgnYm9vdHN0cmFwJyk7IHBhciBkw6lmYXV0XHJcblxyXG4vLyBvciB5b3UgY2FuIGluY2x1ZGUgc3BlY2lmaWMgcGllY2VzXHJcbi8vIHJlcXVpcmUoJ2Jvb3RzdHJhcC9qcy9kaXN0L3Rvb2x0aXAnKTtcclxuLy8gcmVxdWlyZSgnYm9vdHN0cmFwL2pzL2Rpc3QvcG9wb3ZlcicpO1xyXG5cclxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XHJcbiAgICAkKCdbZGF0YS10b2dnbGU9XCJwb3BvdmVyXCJdJykucG9wb3ZlcigpO1xyXG59KTtcclxuLy8gYXNzZXRzL2FwcC5qcyAgXHJcbi8vIGltcG9ydCAnLi9zdHlsZXMvYXBwLmNzcyc7IC8vIEEgdm9pciBwbHVzIHRhcmRcclxuY29uc3QgZW50cmVlU29ydGllID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2VudHJlZVNvcnRpZScpO1xyXG5cclxubG9naW5CdG4uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB7XHJcbiAgICBpZiAoZW50cmVlU29ydGllLnRleHRDb250ZW50ID09PSAnQ29ubmV4aW9uJykge1xyXG4gICAgICAgIC8vIFJlZGlyaWdlciB2ZXJzIGxhIHBhZ2UgZGUgY29ubmV4aW9uXHJcbiAgICAgICAgd2luZG93LmxvY2F0aW9uLmhyZWYgPSAnL2xvZ2luJztcclxuICAgIH0gZWxzZSB7XHJcbiAgICAgICAgLy8gRMOpY29ubmVjdGVyIGwndXRpbGlzYXRldXJcclxuICAgICAgICBmZXRjaCgnL2xvZ291dCcsIHtcclxuICAgICAgICAgICAgbWV0aG9kOiAnUE9TVCdcclxuICAgICAgICB9KVxyXG4gICAgICAgIC50aGVuKCgpID0+IHtcclxuICAgICAgICAgICAgLy8gQWN0dWFsaXNlciBsYSBwYWdlIGFwcsOocyBsYSBkw6ljb25uZXhpb25cclxuICAgICAgICAgICAgd2luZG93LmxvY2F0aW9uLnJlbG9hZCgpO1xyXG4gICAgICAgIH0pXHJcbiAgICAgICAgLmNhdGNoKChlcnJvcikgPT4ge1xyXG4gICAgICAgICAgICBjb25zb2xlLmVycm9yKCdFcnJvcjonLCBlcnJvcik7XHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcbn0pO1xyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG4iLCIvLyBhc3NldHMvYm9vdHN0cmFwLmpzXG5pbXBvcnQgeyBzdGFydFN0aW11bHVzQXBwIH0gZnJvbSAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlJztcblxuLy8gUmVnaXN0ZXJzIFN0aW11bHVzIGNvbnRyb2xsZXJzIGZyb20gY29udHJvbGxlcnMuanNvbiBhbmQgaW4gdGhlIGNvbnRyb2xsZXJzLyBkaXJlY3RvcnlcbnN0YXJ0U3RpbXVsdXNBcHAocmVxdWlyZS5jb250ZXh0KFxuICAgICdAc3ltZm9ueS9zdGltdWx1cy1icmlkZ2UvbGF6eS1jb250cm9sbGVyLWxvYWRlciEuL2NvbnRyb2xsZXJzJyxcbiAgICB0cnVlLFxuICAgIC9cXC5banRdc3g/JC9cbikpO1xuXG4vLyByZWdpc3RlciBhbnkgY3VzdG9tLCAzcmQgcGFydHkgY29udHJvbGxlcnMgaGVyZVxuLy8gYXBwLnJlZ2lzdGVyKCdzb21lX2NvbnRyb2xsZXJfbmFtZScsIFNvbWVJbXBvcnRlZENvbnRyb2xsZXIpO1xuIiwiY29uc29sZS5sb2coJ0hlbGxvIGZyb20gV2VicGFjayBFbmNvcmUhJyk7XHJcbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ0RPTUNvbnRlbnRMb2FkZWQnLCBmdW5jdGlvbigpIHtcclxuICAgIC8vIFPDqWxlY3Rpb25uZXIgdW4gw6lsw6ltZW50IEhUTUwgYXZlYyBzb24gSURcclxuICAgIGNvbnN0IHRpdGxlRWxlbWVudCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyN0aXRsZScpO1xyXG5cclxuICAgIC8vIE1vZGlmaWVyIGxlIGNvbnRlbnUgdGV4dHVlbCBkZSBsJ8OpbMOpbWVudFxyXG4gICAgdGl0bGVFbGVtZW50LnRleHRDb250ZW50ID0gJ05vdXZlYXUgdGl0cmUnO1xyXG59KTsiXSwibmFtZXMiOlsiJCIsImRvY3VtZW50IiwicmVhZHkiLCJwb3BvdmVyIiwiZW50cmVlU29ydGllIiwiZ2V0RWxlbWVudEJ5SWQiLCJsb2dpbkJ0biIsImFkZEV2ZW50TGlzdGVuZXIiLCJ0ZXh0Q29udGVudCIsIndpbmRvdyIsImxvY2F0aW9uIiwiaHJlZiIsImZldGNoIiwibWV0aG9kIiwidGhlbiIsInJlbG9hZCIsImVycm9yIiwiY29uc29sZSIsInN0YXJ0U3RpbXVsdXNBcHAiLCJyZXF1aXJlIiwiY29udGV4dCIsImxvZyIsInRpdGxlRWxlbWVudCIsInF1ZXJ5U2VsZWN0b3IiXSwic291cmNlUm9vdCI6IiJ9