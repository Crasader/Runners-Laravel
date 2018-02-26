/*
 |--------------------------------------------------------------------------
 | Client side store
 |--------------------------------------------------------------------------
 |
 | Register a global js store for the client side app
 | Here we store all datas that will be accesible by all the componenets
 |
 */

import Vue from 'vue'
import Vuex from 'vuex'

// Initialize vuex
Vue.use(Vuex)

// Create and export the store
export default new Vuex.Store({
  //
  strict: process.env.NODE_ENV !== 'production'
})
