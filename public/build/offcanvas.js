(self["webpackChunk"] = self["webpackChunk"] || []).push([["offcanvas"],{

/***/ "./assets/js/offcanvas.js":
/*!********************************!*\
  !*** ./assets/js/offcanvas.js ***!
  \********************************/
/***/ (() => {

// app.js
document.addEventListener('DOMContentLoaded', function () {
  var offcanvas = document.getElementById('offcanvas');
  var openOffcanvasBtn = document.getElementById('openOffcanvas');
  var closeOffcanvasBtn = document.getElementById('closeOffcanvas');
  var overlay = document.getElementById('offcanvasOverlay');
  var body = document.body;
  function openOffcanvas() {
    offcanvas.classList.add('active');
    overlay.classList.add('active');
    body.style.overflow = 'hidden'; // Empêche le défilement du body
  }
  function closeOffcanvas() {
    offcanvas.classList.remove('active');
    overlay.classList.remove('active');
    body.style.overflow = ''; // Rétablit le défilement du body
  }
  if (openOffcanvasBtn) {
    openOffcanvasBtn.addEventListener('click', openOffcanvas);
  }
  if (closeOffcanvasBtn) {
    closeOffcanvasBtn.addEventListener('click', closeOffcanvas);
  }
  overlay.addEventListener('click', closeOffcanvas);
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      closeOffcanvas();
    }
  });
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ var __webpack_exports__ = (__webpack_exec__("./assets/js/offcanvas.js"));
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoib2ZmY2FudmFzLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7O0FBQUE7QUFDQUEsUUFBUSxDQUFDQyxnQkFBZ0IsQ0FBQyxrQkFBa0IsRUFBRSxZQUFXO0VBQ3JELElBQU1DLFNBQVMsR0FBR0YsUUFBUSxDQUFDRyxjQUFjLENBQUMsV0FBVyxDQUFDO0VBQ3RELElBQU1DLGdCQUFnQixHQUFHSixRQUFRLENBQUNHLGNBQWMsQ0FBQyxlQUFlLENBQUM7RUFDakUsSUFBTUUsaUJBQWlCLEdBQUdMLFFBQVEsQ0FBQ0csY0FBYyxDQUFDLGdCQUFnQixDQUFDO0VBQ25FLElBQU1HLE9BQU8sR0FBR04sUUFBUSxDQUFDRyxjQUFjLENBQUMsa0JBQWtCLENBQUM7RUFDM0QsSUFBTUksSUFBSSxHQUFHUCxRQUFRLENBQUNPLElBQUk7RUFFMUIsU0FBU0MsYUFBYUEsQ0FBQSxFQUFHO0lBQ3JCTixTQUFTLENBQUNPLFNBQVMsQ0FBQ0MsR0FBRyxDQUFDLFFBQVEsQ0FBQztJQUNqQ0osT0FBTyxDQUFDRyxTQUFTLENBQUNDLEdBQUcsQ0FBQyxRQUFRLENBQUM7SUFDL0JILElBQUksQ0FBQ0ksS0FBSyxDQUFDQyxRQUFRLEdBQUcsUUFBUSxDQUFDLENBQUM7RUFDcEM7RUFFQSxTQUFTQyxjQUFjQSxDQUFBLEVBQUc7SUFDdEJYLFNBQVMsQ0FBQ08sU0FBUyxDQUFDSyxNQUFNLENBQUMsUUFBUSxDQUFDO0lBQ3BDUixPQUFPLENBQUNHLFNBQVMsQ0FBQ0ssTUFBTSxDQUFDLFFBQVEsQ0FBQztJQUNsQ1AsSUFBSSxDQUFDSSxLQUFLLENBQUNDLFFBQVEsR0FBRyxFQUFFLENBQUMsQ0FBQztFQUM5QjtFQUVBLElBQUlSLGdCQUFnQixFQUFFO0lBQ2xCQSxnQkFBZ0IsQ0FBQ0gsZ0JBQWdCLENBQUMsT0FBTyxFQUFFTyxhQUFhLENBQUM7RUFDN0Q7RUFFQSxJQUFJSCxpQkFBaUIsRUFBRTtJQUNuQkEsaUJBQWlCLENBQUNKLGdCQUFnQixDQUFDLE9BQU8sRUFBRVksY0FBYyxDQUFDO0VBQy9EO0VBRUFQLE9BQU8sQ0FBQ0wsZ0JBQWdCLENBQUMsT0FBTyxFQUFFWSxjQUFjLENBQUM7RUFFakRiLFFBQVEsQ0FBQ0MsZ0JBQWdCLENBQUMsU0FBUyxFQUFFLFVBQVNjLEtBQUssRUFBRTtJQUNqRCxJQUFJQSxLQUFLLENBQUNDLEdBQUcsS0FBSyxRQUFRLEVBQUU7TUFDeEJILGNBQWMsQ0FBQyxDQUFDO0lBQ3BCO0VBQ0osQ0FBQyxDQUFDO0FBQ04sQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL29mZmNhbnZhcy5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBhcHAuanNcclxuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignRE9NQ29udGVudExvYWRlZCcsIGZ1bmN0aW9uKCkge1xyXG4gICAgY29uc3Qgb2ZmY2FudmFzID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ29mZmNhbnZhcycpO1xyXG4gICAgY29uc3Qgb3Blbk9mZmNhbnZhc0J0biA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdvcGVuT2ZmY2FudmFzJyk7XHJcbiAgICBjb25zdCBjbG9zZU9mZmNhbnZhc0J0biA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdjbG9zZU9mZmNhbnZhcycpO1xyXG4gICAgY29uc3Qgb3ZlcmxheSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdvZmZjYW52YXNPdmVybGF5Jyk7XHJcbiAgICBjb25zdCBib2R5ID0gZG9jdW1lbnQuYm9keTtcclxuXHJcbiAgICBmdW5jdGlvbiBvcGVuT2ZmY2FudmFzKCkge1xyXG4gICAgICAgIG9mZmNhbnZhcy5jbGFzc0xpc3QuYWRkKCdhY3RpdmUnKTtcclxuICAgICAgICBvdmVybGF5LmNsYXNzTGlzdC5hZGQoJ2FjdGl2ZScpO1xyXG4gICAgICAgIGJvZHkuc3R5bGUub3ZlcmZsb3cgPSAnaGlkZGVuJzsgLy8gRW1ww6pjaGUgbGUgZMOpZmlsZW1lbnQgZHUgYm9keVxyXG4gICAgfVxyXG5cclxuICAgIGZ1bmN0aW9uIGNsb3NlT2ZmY2FudmFzKCkge1xyXG4gICAgICAgIG9mZmNhbnZhcy5jbGFzc0xpc3QucmVtb3ZlKCdhY3RpdmUnKTtcclxuICAgICAgICBvdmVybGF5LmNsYXNzTGlzdC5yZW1vdmUoJ2FjdGl2ZScpO1xyXG4gICAgICAgIGJvZHkuc3R5bGUub3ZlcmZsb3cgPSAnJzsgLy8gUsOpdGFibGl0IGxlIGTDqWZpbGVtZW50IGR1IGJvZHlcclxuICAgIH1cclxuXHJcbiAgICBpZiAob3Blbk9mZmNhbnZhc0J0bikge1xyXG4gICAgICAgIG9wZW5PZmZjYW52YXNCdG4uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBvcGVuT2ZmY2FudmFzKTtcclxuICAgIH1cclxuXHJcbiAgICBpZiAoY2xvc2VPZmZjYW52YXNCdG4pIHtcclxuICAgICAgICBjbG9zZU9mZmNhbnZhc0J0bi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGNsb3NlT2ZmY2FudmFzKTtcclxuICAgIH1cclxuXHJcbiAgICBvdmVybGF5LmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgY2xvc2VPZmZjYW52YXMpO1xyXG5cclxuICAgIGRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ2tleWRvd24nLCBmdW5jdGlvbihldmVudCkge1xyXG4gICAgICAgIGlmIChldmVudC5rZXkgPT09ICdFc2NhcGUnKSB7XHJcbiAgICAgICAgICAgIGNsb3NlT2ZmY2FudmFzKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiZG9jdW1lbnQiLCJhZGRFdmVudExpc3RlbmVyIiwib2ZmY2FudmFzIiwiZ2V0RWxlbWVudEJ5SWQiLCJvcGVuT2ZmY2FudmFzQnRuIiwiY2xvc2VPZmZjYW52YXNCdG4iLCJvdmVybGF5IiwiYm9keSIsIm9wZW5PZmZjYW52YXMiLCJjbGFzc0xpc3QiLCJhZGQiLCJzdHlsZSIsIm92ZXJmbG93IiwiY2xvc2VPZmZjYW52YXMiLCJyZW1vdmUiLCJldmVudCIsImtleSJdLCJzb3VyY2VSb290IjoiIn0=