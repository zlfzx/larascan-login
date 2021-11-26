/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/qr_login.js ***!
  \**********************************/
Echo.channel('qr-login.' + SESSION_ID).listen('QRLoginEvent', function (e) {
  console.log(e);

  if (e.login) {
    window.location.href = '/dashboard';
  }
});
/******/ })()
;