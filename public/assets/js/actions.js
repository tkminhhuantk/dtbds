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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/actions.js":
/*!*********************************!*\
  !*** ./resources/js/actions.js ***!
  \*********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _classes__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./classes */ "./resources/js/classes.js");

new _classes__WEBPACK_IMPORTED_MODULE_0__["Menu"]();

/***/ }),

/***/ "./resources/js/classes.js":
/*!*********************************!*\
  !*** ./resources/js/classes.js ***!
  \*********************************/
/*! exports provided: Menu */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Menu", function() { return Menu; });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

//Menu
var Menu = /*#__PURE__*/function () {
  function Menu() {
    _classCallCheck(this, Menu);

    this.active = false;
    this.overlay = null;
    this.button = document.querySelector('.header-toggle');
    this.sidebar = document.querySelector('.main-menu');
    this.dismiss = document.querySelector('.header-dismiss button');
    this.dropdown = document.querySelectorAll('.menu-dropdown');
    this.listenerEvent();
  }

  _createClass(Menu, [{
    key: "initOverlay",
    value: function initOverlay() {
      this.overlay = document.createElement('div');
      this.overlay.id = 'bg-overlay';
    }
  }, {
    key: "destroyOverlay",
    value: function destroyOverlay() {
      this.overlay.remove();
    }
  }, {
    key: "show",
    value: function show() {
      var _this = this;

      this.initOverlay();
      document.body.appendChild(this.overlay);
      this.sidebar.classList.toggle('active');

      if (this.sidebar.classList.contains('active')) {
        this.active = true;
        this.overlay.addEventListener('click', function (e) {
          return _this.destroy();
        });
      } else {
        this.active = false;
      }
    }
  }, {
    key: "dropDown",
    value: function dropDown(e) {
      var $this = e.currentTarget;
      var subMenu = $this.nextElementSibling;
      $this.classList.toggle('active');
      subMenu.classList.toggle('active');
    }
  }, {
    key: "destroy",
    value: function destroy() {
      this.active = false;
      this.sidebar.classList.remove('active');
      this.destroyOverlay();
    }
  }, {
    key: "listenerEvent",
    value: function listenerEvent() {
      var _this2 = this;

      this.button.addEventListener('click', function (e) {
        return _this2.show();
      });
      this.dismiss.addEventListener('click', function (e) {
        return _this2.destroy();
      });
      this.dropdown.forEach(function (item) {
        item.addEventListener('click', function (e) {
          return _this2.dropDown(e);
        });
      });
    }
  }]);

  return Menu;
}();

/***/ }),

/***/ 0:
/*!***************************************!*\
  !*** multi ./resources/js/actions.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/XAMPP/xamppfiles/htdocs/dtbds/resources/js/actions.js */"./resources/js/actions.js");


/***/ })

/******/ });