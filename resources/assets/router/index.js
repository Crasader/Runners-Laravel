/*
 |--------------------------------------------------------------------------
 | Client side router
 |--------------------------------------------------------------------------
 |
 | Register all the routes resolved by the client app
 |
 */

import Vue from 'vue'
import Router from 'vue-router'

// Conponents imports
import HomePage from '../views/HomePage.vue'

// Initialize the router
Vue.use(Router)

// Create and export the router
export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home-page',
      component: HomePage
    },
    {
      path: '*',
      redirect: '/'
    }
  ]
})
