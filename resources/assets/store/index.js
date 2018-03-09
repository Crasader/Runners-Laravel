/**
 * Client side store
 *
 * Register a global js store for the client side app
 * Here we store all datas that will be accesible by all the componenets
 *
 * @author Bastien Nicoud
 */

import Vue from 'vue'
import Vuex from 'vuex'

// Import store modules
import UserModule from './user'

// Initialize vuex
Vue.use(Vuex)

// Create and export the store
export default new Vuex.Store({
  // Bind the modules in the store
  modules: {
    user: UserModule
  },
  // Force to use actions (not commit directly mutations)
  strict: process.env.NODE_ENV !== 'production'
})
