webpackJsonp([0],{

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var Component = __webpack_require__(11)(
  /* script */
  __webpack_require__(45),
  /* template */
  __webpack_require__(46),
  /* styles */
  null,
  /* scopeId */
  null,
  /* moduleIdentifier (server only) */
  null
)
Component.options.__file = "C:\\laragon\\www\\Impaciente\\resources\\assets\\js\\components\\Friend.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key.substr(0, 2) !== "__"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Friend.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-a960f832", Component.options)
  } else {
    hotAPI.reload("data-v-a960f832", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 45:
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
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    mounted: function mounted() {
        var _this = this;

        this.$http.get('/check_status_amistades/' + this.perfil_user_id).then(function (resp) {
            console.log(resp);
            _this.status = resp.body.status;
            _this.loading = false;
        });
    },

    props: ['perfil_user_id'],
    data: function data() {
        return {
            status: '',
            loading: true
        };
    },

    methods: {
        agregar_amigo: function agregar_amigo() {
            var _this2 = this;

            this.loading == true;
            this.$http.get('/agregar_paciente/' + this.perfil_user_id).then(function (resp) {
                if (resp.body == 1) _this2.status == 'esperando';
                new Noty({

                    type: 'danger',
                    layout: 'bottonleft',
                    text: 'Solicitud enviada.',
                    timeout: 3000
                }).show();
                _this2.loading == false;
            });
        },
        aceptar_amigo: function aceptar_amigo() {
            var _this3 = this;

            this.loading == true;
            this.$http.get('/aceptar_tratante/' + this.perfil_user_id).then(function (resp) {
                if (resp.body == 1) _this3.status == 'amigos';

                new Noty({

                    type: 'danger',
                    layout: 'bottonleft',
                    text: 'tu tienes un nuevo tratante ahora.',
                    timeout: 3000
                }).show();
                _this3.loading == false;
            });
        }
    }

});

/***/ }),

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', [(_vm.loading) ? _c('p', {
    staticClass: "text-center"
  }, [_vm._v("\n       Cargando...\n   ")]) : _vm._e(), _vm._v(" "), (!_vm.loading) ? _c('p', {
    staticClass: "text-center"
  }, [(_vm.status == 0) ? _c('button', {
    staticClass: "btn btn-info",
    on: {
      "click": _vm.agregar_amigo
    }
  }, [_vm._v("Buscar Paciente")]) : _vm._e(), _vm._v(" "), (_vm.status == 'pendiente') ? _c('button', {
    staticClass: "btn btn-info",
    on: {
      "click": _vm.aceptar_amigo
    }
  }, [_vm._v("Aceptar Tratante")]) : _vm._e(), _vm._v(" "), (_vm.status == 'esperando') ? _c('span', {
    staticClass: "text-success"
  }, [_vm._v("Esperando Respuesta")]) : _vm._e(), _vm._v(" "), (_vm.status == 'amigos') ? _c('span', {
    staticClass: "text-success"
  }, [_vm._v("En consulta")]) : _vm._e()]) : _vm._e()])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-a960f832", module.exports)
  }
}

/***/ })

});