/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/js/laravel-echo-setup.js ***!
  \********************************************/
__webpack_require__.r(__webpack_exports__);
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'laravel-echo'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());

window.Echo = new Object(function webpackMissingModule() { var e = new Error("Cannot find module 'laravel-echo'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())({
  broadcaster: 'socket.io',
  host: window.loaction.hostname + ":" + window.laravel_echo_port
});
/******/ })()
;