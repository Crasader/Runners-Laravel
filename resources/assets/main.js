/*
 |--------------------------------------------------------------------------
 | Client side app entry point
 |--------------------------------------------------------------------------
 |
 | This file initialise the client-side app
 | You foud here all the imports and library instanciations
 | All the assets are compiled/transpiled by webpack to generate dist files in the public directory
 |
 */

// Vue main
import Vue from 'vue'
import App from './App'

// Axios (Xhttp calls)
import axios from 'axios'
import VueAxios from 'vue-axios'

// Vue modules (client-side routing and state managment)
import router from './router'
import store from './store'

// Css framework components
import Buefy from 'buefy'

// Vue initialisation
Vue.use(Buefy)
Vue.use(VueAxios, axios)
Vue.config.productionTip = false

// Initialize the vue app
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
})
