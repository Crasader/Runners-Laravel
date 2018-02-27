/*
 |--------------------------------------------------------------------------
 | Client side router
 |--------------------------------------------------------------------------
 |
 | Register all the routes resolved by the client app
 | @author Bastien Nicoud
 |
 */

import Vue from 'vue'
import Router from 'vue-router'

// Import all the routes from sub modules
import BaseRoutes from './base'
import RunsRoutes from './runs'
import ErrorRoutes from './errors'

// Initialize the router
Vue.use(Router)

// Concatenate all the routes modules
const routes = BaseRoutes.concat(RunsRoutes, ErrorRoutes)

// Create and export the router
export default new Router({
  mode: 'history',
  routes,
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { x: 0, y: 0 }
    }
  },
  // linkExactActiveClass: 'is-active',
  linkActiveClass: 'is-active'
})
