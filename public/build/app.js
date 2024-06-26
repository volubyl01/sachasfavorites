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

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.promise.js */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../styles/app.css */ "./assets/styles/app.css");
/* harmony import */ var bootstrap_dist_css_bootstrap_min_css__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! bootstrap/dist/css/bootstrap.min.css */ "./node_modules/bootstrap/dist/css/bootstrap.min.css");
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");



// // importer bootstrap.js



// importer le css de bootstrap


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

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_bootstrap_dist_js_boo-da594f","vendors-node_modules_bootstrap_dist_css_bootstrap_min_css-node_modules_core-js_modules_es_obj-107731"], () => (__webpack_exec__("./assets/js/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7QUFBQSxpRUFBZTtBQUNmLENBQUM7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQ0R1QjtBQUN4QjtBQUNtQjtBQUNROztBQUUzQjtBQUM4Qzs7QUFFOUM7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFHQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDa0M7QUFDbEM7O0FBSUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBOztBQUdBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQUEsQ0FBQyxDQUFDQyxRQUFRLENBQUMsQ0FBQ0MsS0FBSyxDQUFDLFlBQVc7RUFDekJGLENBQUMsQ0FBQyx5QkFBeUIsQ0FBQyxDQUFDRyxPQUFPLENBQUMsQ0FBQztBQUMxQyxDQUFDLENBQUM7QUFDRjtBQUNBOztBQUVBLElBQU1DLFlBQVksR0FBR0gsUUFBUSxDQUFDSSxjQUFjLENBQUMsY0FBYyxDQUFDO0FBRTVEQyxRQUFRLENBQUNDLGdCQUFnQixDQUFDLE9BQU8sRUFBRSxZQUFNO0VBQ3JDLElBQUlILFlBQVksQ0FBQ0ksV0FBVyxLQUFLLFdBQVcsRUFBRTtJQUMxQztJQUNBQyxNQUFNLENBQUNDLFFBQVEsQ0FBQ0MsSUFBSSxHQUFHLFFBQVE7RUFDbkMsQ0FBQyxNQUFNO0lBQ0g7SUFDQUMsS0FBSyxDQUFDLFNBQVMsRUFBRTtNQUNiQyxNQUFNLEVBQUU7SUFDWixDQUFDLENBQUMsQ0FDREMsSUFBSSxDQUFDLFlBQU07TUFDUjtNQUNBTCxNQUFNLENBQUNDLFFBQVEsQ0FBQ0ssTUFBTSxDQUFDLENBQUM7SUFDNUIsQ0FBQyxDQUFDLFNBQ0ksQ0FBQyxVQUFDQyxLQUFLLEVBQUs7TUFDZEMsT0FBTyxDQUFDRCxLQUFLLENBQUMsUUFBUSxFQUFFQSxLQUFLLENBQUM7SUFDbEMsQ0FBQyxDQUFDO0VBQ047QUFDSixDQUFDLENBQUM7Ozs7Ozs7Ozs7O0FDdkVGIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2NvbnRyb2xsZXJzL2NvbnRyb2xsZXJzLmpzb24iLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2FwcC5jc3M/MjBhMyJdLCJzb3VyY2VzQ29udGVudCI6WyJleHBvcnQgZGVmYXVsdCB7XG59OyIsImltcG9ydCAnQHBvcHBlcmpzL2NvcmUnO1xyXG4vLyAvLyBpbXBvcnRlciBib290c3RyYXAuanNcclxuaW1wb3J0ICdib290c3RyYXAnO1xyXG5pbXBvcnQgJy4uL3N0eWxlcy9hcHAuY3NzJztcclxuXHJcbi8vIGltcG9ydGVyIGxlIGNzcyBkZSBib290c3RyYXBcclxuaW1wb3J0ICdib290c3RyYXAvZGlzdC9jc3MvYm9vdHN0cmFwLm1pbi5jc3MnO1xyXG5cclxuLy8gaW1wb3J0IHsgc3RhcnRTdGltdWx1c0FwcCB9IGZyb20gJ0BzeW1mb255L3N0aW11bHVzLWJyaWRnZSc7XHJcblxyXG4vLyBleHBvcnQgY29uc3QgYXBwID0gc3RhcnRTdGltdWx1c0FwcChyZXF1aXJlLmNvbnRleHQoXHJcbi8vICAgICAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIhLi9jb250cm9sbGVycycsXHJcbi8vICAgICB0cnVlLFxyXG4vLyAgICAgL1xcLihqfHQpc3g/JC9cclxuLy8gKSk7XHJcblxyXG5cclxuLypcclxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxyXG4gKlxyXG4gKiBUaGlzIGZpbGUgd2lsbCBiZSBpbmNsdWRlZCBvbnRvIHRoZSBwYWdlIHZpYSB0aGUgaW1wb3J0bWFwKCkgVHdpZyBmdW5jdGlvbixcclxuICogd2hpY2ggc2hvdWxkIGFscmVhZHkgYmUgaW4geW91ciBiYXNlLmh0bWwudHdpZy5cclxuICovXHJcbmltcG9ydCAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlJztcclxuLy8gaW1wb3J0ICcuL3N0eWxlcy9hcHAuY3NzJztcclxuXHJcblxyXG5cclxuLy8gaW1wb3J0IHsgY3JlYXRlQXBwIH0gZnJvbSAndnVlJztcclxuLy8gaW1wb3J0IGFwcCBmcm9tICcuL2NvbXBvbmVudHMvSGVsbG8tV29ybGQudnVlJztcclxuXHJcbi8vIGNvbnN0IGFwcCA9IGNyZWF0ZUFwcCh7fSk7XHJcbi8vIGFwcC5jb21wb25lbnQoJ2hlbGxvLXdvcmxkJywgSGVsbG9Xb3JsZCk7XHJcblxyXG4vLyBhcHAubW91bnQoJyNhcHAnKTtcclxuXHJcblxyXG4vLyBjb25zdCAkID0gcmVxdWlyZSgnanF1ZXJ5Jyk7IFBhciBkw6lmYXV0XHJcbi8vIHRoaXMgXCJtb2RpZmllc1wiIHRoZSBqcXVlcnkgbW9kdWxlOiBhZGRpbmcgYmVoYXZpb3IgdG8gaXRcclxuLy8gdGhlIGJvb3RzdHJhcCBtb2R1bGUgZG9lc24ndCBleHBvcnQvcmV0dXJuIGFueXRoaW5nXHJcbi8vIHJlcXVpcmUoJ2Jvb3RzdHJhcCcpOyBwYXIgZMOpZmF1dFxyXG5cclxuLy8gb3IgeW91IGNhbiBpbmNsdWRlIHNwZWNpZmljIHBpZWNlc1xyXG4vLyByZXF1aXJlKCdib290c3RyYXAvanMvZGlzdC90b29sdGlwJyk7XHJcbi8vIHJlcXVpcmUoJ2Jvb3RzdHJhcC9qcy9kaXN0L3BvcG92ZXInKTtcclxuXHJcbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG4gICAgJCgnW2RhdGEtdG9nZ2xlPVwicG9wb3ZlclwiXScpLnBvcG92ZXIoKTtcclxufSk7XHJcbi8vIGFzc2V0cy9hcHAuanMgIFxyXG4vLyBpbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnOyAvLyBBIHZvaXIgcGx1cyB0YXJkXHJcblxyXG5jb25zdCBlbnRyZWVTb3J0aWUgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZW50cmVlU29ydGllJyk7XHJcblxyXG5sb2dpbkJ0bi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IHtcclxuICAgIGlmIChlbnRyZWVTb3J0aWUudGV4dENvbnRlbnQgPT09ICdDb25uZXhpb24nKSB7XHJcbiAgICAgICAgLy8gUmVkaXJpZ2VyIHZlcnMgbGEgcGFnZSBkZSBjb25uZXhpb25cclxuICAgICAgICB3aW5kb3cubG9jYXRpb24uaHJlZiA9ICcvbG9naW4nO1xyXG4gICAgfSBlbHNlIHtcclxuICAgICAgICAvLyBEw6ljb25uZWN0ZXIgbCd1dGlsaXNhdGV1clxyXG4gICAgICAgIGZldGNoKCcvbG9nb3V0Jywge1xyXG4gICAgICAgICAgICBtZXRob2Q6ICdQT1NUJ1xyXG4gICAgICAgIH0pXHJcbiAgICAgICAgLnRoZW4oKCkgPT4ge1xyXG4gICAgICAgICAgICAvLyBBY3R1YWxpc2VyIGxhIHBhZ2UgYXByw6hzIGxhIGTDqWNvbm5leGlvblxyXG4gICAgICAgICAgICB3aW5kb3cubG9jYXRpb24ucmVsb2FkKCk7XHJcbiAgICAgICAgfSlcclxuICAgICAgICAuY2F0Y2goKGVycm9yKSA9PiB7XHJcbiAgICAgICAgICAgIGNvbnNvbGUuZXJyb3IoJ0Vycm9yOicsIGVycm9yKTtcclxuICAgICAgICB9KTtcclxuICAgIH1cclxufSk7XHJcblxyXG5cclxuXHJcblxyXG5cclxuIiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Il0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5IiwicG9wb3ZlciIsImVudHJlZVNvcnRpZSIsImdldEVsZW1lbnRCeUlkIiwibG9naW5CdG4iLCJhZGRFdmVudExpc3RlbmVyIiwidGV4dENvbnRlbnQiLCJ3aW5kb3ciLCJsb2NhdGlvbiIsImhyZWYiLCJmZXRjaCIsIm1ldGhvZCIsInRoZW4iLCJyZWxvYWQiLCJlcnJvciIsImNvbnNvbGUiXSwic291cmNlUm9vdCI6IiJ9