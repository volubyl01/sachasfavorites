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
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");
/* harmony import */ var _js_app_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./js/app.js */ "./assets/js/app.js");
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)



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
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");




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

jquery__WEBPACK_IMPORTED_MODULE_2___default()(document).ready(function () {
  jquery__WEBPACK_IMPORTED_MODULE_2___default()('[data-toggle="popover"]').popover();
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
/******/ __webpack_require__.O(0, ["vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_jquery_dist_jquery_js-135086"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7QUFBQSxpRUFBZTtBQUNmLENBQUM7Ozs7Ozs7Ozs7Ozs7QUNERDtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDMEI7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQ1JIOztBQUd2Qjs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUdBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNrQztBQUNsQzs7QUFJQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7O0FBR0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOztBQUVBQSw2Q0FBQyxDQUFDQyxRQUFRLENBQUMsQ0FBQ0MsS0FBSyxDQUFDLFlBQVc7RUFDekJGLDZDQUFDLENBQUMseUJBQXlCLENBQUMsQ0FBQ0csT0FBTyxDQUFDLENBQUM7QUFDMUMsQ0FBQyxDQUFDO0FBQ0Y7QUFDQTs7QUFFQSxJQUFNQyxZQUFZLEdBQUdILFFBQVEsQ0FBQ0ksY0FBYyxDQUFDLGNBQWMsQ0FBQztBQUU1REMsUUFBUSxDQUFDQyxnQkFBZ0IsQ0FBQyxPQUFPLEVBQUUsWUFBTTtFQUNyQyxJQUFJSCxZQUFZLENBQUNJLFdBQVcsS0FBSyxXQUFXLEVBQUU7SUFDMUM7SUFDQUMsTUFBTSxDQUFDQyxRQUFRLENBQUNDLElBQUksR0FBRyxRQUFRO0VBQ25DLENBQUMsTUFBTTtJQUNIO0lBQ0FDLEtBQUssQ0FBQyxTQUFTLEVBQUU7TUFDYkMsTUFBTSxFQUFFO0lBQ1osQ0FBQyxDQUFDLENBQ0RDLElBQUksQ0FBQyxZQUFNO01BQ1I7TUFDQUwsTUFBTSxDQUFDQyxRQUFRLENBQUNLLE1BQU0sQ0FBQyxDQUFDO0lBQzVCLENBQUMsQ0FBQyxTQUNJLENBQUMsVUFBQ0MsS0FBSyxFQUFLO01BQ2RDLE9BQU8sQ0FBQ0QsS0FBSyxDQUFDLFFBQVEsRUFBRUEsS0FBSyxDQUFDO0lBQ2xDLENBQUMsQ0FBQztFQUNOO0FBQ0osQ0FBQyxDQUFDOzs7Ozs7Ozs7OztBQ2xFRiIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9jb250cm9sbGVycy9jb250cm9sbGVycy5qc29uIiwid2VicGFjazovLy8uL2Fzc2V0cy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2FwcC5jc3M/M2ZiYSJdLCJzb3VyY2VzQ29udGVudCI6WyJleHBvcnQgZGVmYXVsdCB7XG59OyIsIi8qXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXG4gKlxuICogV2UgcmVjb21tZW5kIGluY2x1ZGluZyB0aGUgYnVpbHQgdmVyc2lvbiBvZiB0aGlzIEphdmFTY3JpcHQgZmlsZVxuICogKGFuZCBpdHMgQ1NTIGZpbGUpIGluIHlvdXIgYmFzZSBsYXlvdXQgKGJhc2UuaHRtbC50d2lnKS5cbiAqL1xuXG4vLyBhbnkgQ1NTIHlvdSBpbXBvcnQgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXG5pbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnO1xuXG5pbXBvcnQgJy4vanMvYXBwLmpzJ1xuXG4iLCJpbXBvcnQgJCBmcm9tICdqcXVlcnknO1xyXG5cclxuXHJcbi8vIGltcG9ydCB7IHN0YXJ0U3RpbXVsdXNBcHAgfSBmcm9tICdAc3ltZm9ueS9zdGltdWx1cy1icmlkZ2UnO1xyXG5cclxuLy8gZXhwb3J0IGNvbnN0IGFwcCA9IHN0YXJ0U3RpbXVsdXNBcHAocmVxdWlyZS5jb250ZXh0KFxyXG4vLyAgICAgJ0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyIS4vY29udHJvbGxlcnMnLFxyXG4vLyAgICAgdHJ1ZSxcclxuLy8gICAgIC9cXC4oanx0KXN4PyQvXHJcbi8vICkpO1xyXG5cclxuXHJcbi8qXHJcbiAqIFdlbGNvbWUgdG8geW91ciBhcHAncyBtYWluIEphdmFTY3JpcHQgZmlsZSFcclxuICpcclxuICogVGhpcyBmaWxlIHdpbGwgYmUgaW5jbHVkZWQgb250byB0aGUgcGFnZSB2aWEgdGhlIGltcG9ydG1hcCgpIFR3aWcgZnVuY3Rpb24sXHJcbiAqIHdoaWNoIHNob3VsZCBhbHJlYWR5IGJlIGluIHlvdXIgYmFzZS5odG1sLnR3aWcuXHJcbiAqL1xyXG5pbXBvcnQgJ0BzeW1mb255L3N0aW11bHVzLWJyaWRnZSc7XHJcbi8vIGltcG9ydCAnLi9zdHlsZXMvYXBwLmNzcyc7XHJcblxyXG5cclxuXHJcbi8vIGltcG9ydCB7IGNyZWF0ZUFwcCB9IGZyb20gJ3Z1ZSc7XHJcbi8vIGltcG9ydCBhcHAgZnJvbSAnLi9jb21wb25lbnRzL0hlbGxvLVdvcmxkLnZ1ZSc7XHJcblxyXG4vLyBjb25zdCBhcHAgPSBjcmVhdGVBcHAoe30pO1xyXG4vLyBhcHAuY29tcG9uZW50KCdoZWxsby13b3JsZCcsIEhlbGxvV29ybGQpO1xyXG5cclxuLy8gYXBwLm1vdW50KCcjYXBwJyk7XHJcblxyXG5cclxuLy8gY29uc3QgJCA9IHJlcXVpcmUoJ2pxdWVyeScpOyBQYXIgZMOpZmF1dFxyXG4vLyB0aGlzIFwibW9kaWZpZXNcIiB0aGUganF1ZXJ5IG1vZHVsZTogYWRkaW5nIGJlaGF2aW9yIHRvIGl0XHJcbi8vIHRoZSBib290c3RyYXAgbW9kdWxlIGRvZXNuJ3QgZXhwb3J0L3JldHVybiBhbnl0aGluZ1xyXG4vLyByZXF1aXJlKCdib290c3RyYXAnKTsgcGFyIGTDqWZhdXRcclxuXHJcbi8vIG9yIHlvdSBjYW4gaW5jbHVkZSBzcGVjaWZpYyBwaWVjZXNcclxuLy8gcmVxdWlyZSgnYm9vdHN0cmFwL2pzL2Rpc3QvdG9vbHRpcCcpO1xyXG4vLyByZXF1aXJlKCdib290c3RyYXAvanMvZGlzdC9wb3BvdmVyJyk7XHJcblxyXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuICAgICQoJ1tkYXRhLXRvZ2dsZT1cInBvcG92ZXJcIl0nKS5wb3BvdmVyKCk7XHJcbn0pO1xyXG4vLyBhc3NldHMvYXBwLmpzICBcclxuLy8gaW1wb3J0ICcuL3N0eWxlcy9hcHAuY3NzJzsgLy8gQSB2b2lyIHBsdXMgdGFyZFxyXG5cclxuY29uc3QgZW50cmVlU29ydGllID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2VudHJlZVNvcnRpZScpO1xyXG5cclxubG9naW5CdG4uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB7XHJcbiAgICBpZiAoZW50cmVlU29ydGllLnRleHRDb250ZW50ID09PSAnQ29ubmV4aW9uJykge1xyXG4gICAgICAgIC8vIFJlZGlyaWdlciB2ZXJzIGxhIHBhZ2UgZGUgY29ubmV4aW9uXHJcbiAgICAgICAgd2luZG93LmxvY2F0aW9uLmhyZWYgPSAnL2xvZ2luJztcclxuICAgIH0gZWxzZSB7XHJcbiAgICAgICAgLy8gRMOpY29ubmVjdGVyIGwndXRpbGlzYXRldXJcclxuICAgICAgICBmZXRjaCgnL2xvZ291dCcsIHtcclxuICAgICAgICAgICAgbWV0aG9kOiAnUE9TVCdcclxuICAgICAgICB9KVxyXG4gICAgICAgIC50aGVuKCgpID0+IHtcclxuICAgICAgICAgICAgLy8gQWN0dWFsaXNlciBsYSBwYWdlIGFwcsOocyBsYSBkw6ljb25uZXhpb25cclxuICAgICAgICAgICAgd2luZG93LmxvY2F0aW9uLnJlbG9hZCgpO1xyXG4gICAgICAgIH0pXHJcbiAgICAgICAgLmNhdGNoKChlcnJvcikgPT4ge1xyXG4gICAgICAgICAgICBjb25zb2xlLmVycm9yKCdFcnJvcjonLCBlcnJvcik7XHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcbn0pO1xyXG5cclxuXHJcblxyXG5cclxuXHJcbiIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsInBvcG92ZXIiLCJlbnRyZWVTb3J0aWUiLCJnZXRFbGVtZW50QnlJZCIsImxvZ2luQnRuIiwiYWRkRXZlbnRMaXN0ZW5lciIsInRleHRDb250ZW50Iiwid2luZG93IiwibG9jYXRpb24iLCJocmVmIiwiZmV0Y2giLCJtZXRob2QiLCJ0aGVuIiwicmVsb2FkIiwiZXJyb3IiLCJjb25zb2xlIl0sInNvdXJjZVJvb3QiOiIifQ==