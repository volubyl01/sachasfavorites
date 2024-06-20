"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers/controllers.json":
/*!************************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers/controllers.json ***!
  \************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

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

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.promise.js */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");


// import { startStimulusApp } from '@symfony/stimulus-bridge';

// export const app = startStimulusApp(require.context(
//     '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
//     true,
//     /\.(j|t)sx?$/
// ));

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

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_symfony_stimulus-bridge_dist_index_js","vendors-node_modules_core-js_modules_es_object_to-string_js-node_modules_core-js_modules_es_p-2a1352"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7QUFBQSxpRUFBZTtBQUNmLENBQUM7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQ0REOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBR0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ2tDO0FBQ2xDOztBQUlBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTs7QUFHQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUFBLENBQUMsQ0FBQ0MsUUFBUSxDQUFDLENBQUNDLEtBQUssQ0FBQyxZQUFXO0VBQ3pCRixDQUFDLENBQUMseUJBQXlCLENBQUMsQ0FBQ0csT0FBTyxDQUFDLENBQUM7QUFDMUMsQ0FBQyxDQUFDO0FBQ0Y7QUFDQTtBQUNBLElBQU1DLFlBQVksR0FBR0gsUUFBUSxDQUFDSSxjQUFjLENBQUMsY0FBYyxDQUFDO0FBRTVEQyxRQUFRLENBQUNDLGdCQUFnQixDQUFDLE9BQU8sRUFBRSxZQUFNO0VBQ3JDLElBQUlILFlBQVksQ0FBQ0ksV0FBVyxLQUFLLFdBQVcsRUFBRTtJQUMxQztJQUNBQyxNQUFNLENBQUNDLFFBQVEsQ0FBQ0MsSUFBSSxHQUFHLFFBQVE7RUFDbkMsQ0FBQyxNQUFNO0lBQ0g7SUFDQUMsS0FBSyxDQUFDLFNBQVMsRUFBRTtNQUNiQyxNQUFNLEVBQUU7SUFDWixDQUFDLENBQUMsQ0FDREMsSUFBSSxDQUFDLFlBQU07TUFDUjtNQUNBTCxNQUFNLENBQUNDLFFBQVEsQ0FBQ0ssTUFBTSxDQUFDLENBQUM7SUFDNUIsQ0FBQyxDQUFDLFNBQ0ksQ0FBQyxVQUFDQyxLQUFLLEVBQUs7TUFDZEMsT0FBTyxDQUFDRCxLQUFLLENBQUMsUUFBUSxFQUFFQSxLQUFLLENBQUM7SUFDbEMsQ0FBQyxDQUFDO0VBQ047QUFDSixDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY29udHJvbGxlcnMvY29udHJvbGxlcnMuanNvbiIsIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIl0sInNvdXJjZXNDb250ZW50IjpbImV4cG9ydCBkZWZhdWx0IHtcbn07IiwiLy8gaW1wb3J0IHsgc3RhcnRTdGltdWx1c0FwcCB9IGZyb20gJ0BzeW1mb255L3N0aW11bHVzLWJyaWRnZSc7XHJcblxyXG4vLyBleHBvcnQgY29uc3QgYXBwID0gc3RhcnRTdGltdWx1c0FwcChyZXF1aXJlLmNvbnRleHQoXHJcbi8vICAgICAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIhLi9jb250cm9sbGVycycsXHJcbi8vICAgICB0cnVlLFxyXG4vLyAgICAgL1xcLihqfHQpc3g/JC9cclxuLy8gKSk7XHJcblxyXG5cclxuLypcclxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxyXG4gKlxyXG4gKiBUaGlzIGZpbGUgd2lsbCBiZSBpbmNsdWRlZCBvbnRvIHRoZSBwYWdlIHZpYSB0aGUgaW1wb3J0bWFwKCkgVHdpZyBmdW5jdGlvbixcclxuICogd2hpY2ggc2hvdWxkIGFscmVhZHkgYmUgaW4geW91ciBiYXNlLmh0bWwudHdpZy5cclxuICovXHJcbmltcG9ydCAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlJztcclxuLy8gaW1wb3J0ICcuL3N0eWxlcy9hcHAuY3NzJztcclxuXHJcblxyXG5cclxuLy8gaW1wb3J0IHsgY3JlYXRlQXBwIH0gZnJvbSAndnVlJztcclxuLy8gaW1wb3J0IGFwcCBmcm9tICcuL2NvbXBvbmVudHMvSGVsbG8tV29ybGQudnVlJztcclxuXHJcbi8vIGNvbnN0IGFwcCA9IGNyZWF0ZUFwcCh7fSk7XHJcbi8vIGFwcC5jb21wb25lbnQoJ2hlbGxvLXdvcmxkJywgSGVsbG9Xb3JsZCk7XHJcblxyXG4vLyBhcHAubW91bnQoJyNhcHAnKTtcclxuXHJcblxyXG4vLyBjb25zdCAkID0gcmVxdWlyZSgnanF1ZXJ5Jyk7IFBhciBkw6lmYXV0XHJcbi8vIHRoaXMgXCJtb2RpZmllc1wiIHRoZSBqcXVlcnkgbW9kdWxlOiBhZGRpbmcgYmVoYXZpb3IgdG8gaXRcclxuLy8gdGhlIGJvb3RzdHJhcCBtb2R1bGUgZG9lc24ndCBleHBvcnQvcmV0dXJuIGFueXRoaW5nXHJcbi8vIHJlcXVpcmUoJ2Jvb3RzdHJhcCcpOyBwYXIgZMOpZmF1dFxyXG5cclxuLy8gb3IgeW91IGNhbiBpbmNsdWRlIHNwZWNpZmljIHBpZWNlc1xyXG4vLyByZXF1aXJlKCdib290c3RyYXAvanMvZGlzdC90b29sdGlwJyk7XHJcbi8vIHJlcXVpcmUoJ2Jvb3RzdHJhcC9qcy9kaXN0L3BvcG92ZXInKTtcclxuXHJcbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG4gICAgJCgnW2RhdGEtdG9nZ2xlPVwicG9wb3ZlclwiXScpLnBvcG92ZXIoKTtcclxufSk7XHJcbi8vIGFzc2V0cy9hcHAuanMgIFxyXG4vLyBpbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnOyAvLyBBIHZvaXIgcGx1cyB0YXJkXHJcbmNvbnN0IGVudHJlZVNvcnRpZSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdlbnRyZWVTb3J0aWUnKTtcclxuXHJcbmxvZ2luQnRuLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4ge1xyXG4gICAgaWYgKGVudHJlZVNvcnRpZS50ZXh0Q29udGVudCA9PT0gJ0Nvbm5leGlvbicpIHtcclxuICAgICAgICAvLyBSZWRpcmlnZXIgdmVycyBsYSBwYWdlIGRlIGNvbm5leGlvblxyXG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbi5ocmVmID0gJy9sb2dpbic7XHJcbiAgICB9IGVsc2Uge1xyXG4gICAgICAgIC8vIETDqWNvbm5lY3RlciBsJ3V0aWxpc2F0ZXVyXHJcbiAgICAgICAgZmV0Y2goJy9sb2dvdXQnLCB7XHJcbiAgICAgICAgICAgIG1ldGhvZDogJ1BPU1QnXHJcbiAgICAgICAgfSlcclxuICAgICAgICAudGhlbigoKSA9PiB7XHJcbiAgICAgICAgICAgIC8vIEFjdHVhbGlzZXIgbGEgcGFnZSBhcHLDqHMgbGEgZMOpY29ubmV4aW9uXHJcbiAgICAgICAgICAgIHdpbmRvdy5sb2NhdGlvbi5yZWxvYWQoKTtcclxuICAgICAgICB9KVxyXG4gICAgICAgIC5jYXRjaCgoZXJyb3IpID0+IHtcclxuICAgICAgICAgICAgY29uc29sZS5lcnJvcignRXJyb3I6JywgZXJyb3IpO1xyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG59KTtcclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuIl0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5IiwicG9wb3ZlciIsImVudHJlZVNvcnRpZSIsImdldEVsZW1lbnRCeUlkIiwibG9naW5CdG4iLCJhZGRFdmVudExpc3RlbmVyIiwidGV4dENvbnRlbnQiLCJ3aW5kb3ciLCJsb2NhdGlvbiIsImhyZWYiLCJmZXRjaCIsIm1ldGhvZCIsInRoZW4iLCJyZWxvYWQiLCJlcnJvciIsImNvbnNvbGUiXSwic291cmNlUm9vdCI6IiJ9