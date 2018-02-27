webpackJsonp([0],{

/***/ 52:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(53)
}
var normalizeComponent = __webpack_require__(5)
/* script */
var __vue_script__ = __webpack_require__(55)
/* template */
var __vue_template__ = __webpack_require__(56)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-d23b73f0"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/components/SecondPage.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-d23b73f0", Component.options)
  } else {
    hotAPI.reload("data-v-d23b73f0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 53:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(54);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(51)("191fcd28", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-d23b73f0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/sass-loader/lib/loader.js!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./SecondPage.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-d23b73f0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/sass-loader/lib/loader.js!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./SecondPage.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 54:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(50)(false);
// imports


// module
exports.push([module.i, "/*\n |--------------------------------------------------------------------------\n | App global scss config\n |--------------------------------------------------------------------------\n |\n | This file allows you to customize the global scss vars used by the Bulma framework\n | You find all the possible variabes in the official bulma documentation\n | We also foud (end of this file) custom global vars added just for our needs\n |\n */\n/*\n |--------------------------------------------------------------------------\n | Buefy / Bulma global config\n |--------------------------------------------------------------------------\n */\n/*$colors: (\n    \"white\": ($white, $black),\n    \"black\": ($black, $white),\n    \"light\": ($light, $light-invert),\n    \"dark\": ($dark, $dark-invert),\n    \"primary\": ($primary, $primary-invert),\n    \"info\": ($info, $info-invert),\n    \"success\": ($success, $success-invert),\n    \"warning\": ($warning, $warning-invert),\n    \"danger\": ($danger, $danger-invert),\n    \"twitter\": ($twitter, $twitter-invert)\n);*/\n/*\n |--------------------------------------------------------------------------\n | Application specifc custom vars\n |--------------------------------------------------------------------------\n */\nh1[data-v-d23b73f0] {\n  color: red;\n}\nh3[data-v-d23b73f0] {\n  color: blue;\n}\n", ""]);

// exports


/***/ }),

/***/ 55:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  //
});

/***/ }),

/***/ 56:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "secondpage" },
    [
      _c("h1", [_vm._v("Hello")]),
      _vm._v(" "),
      _c("b-message", { attrs: { title: "Success", type: "is-success" } }, [
        _vm._v("\n    Test second page !?\n  ")
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-d23b73f0", module.exports)
  }
}

/***/ })

});