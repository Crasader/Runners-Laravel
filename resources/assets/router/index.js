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
import RunsList from '../views/Runs/RunsList.vue'

// Initialize the router
Vue.use(Router)

// Create and export the router
export default new Router({
  mode: 'history',
  routes: [
    // Homepages / dashboards
    {
      path: '/',
      name: 'home-page',
      component: HomePage
    },
    // Runs
    {
      path: 'runs',
      name: 'runs-list',
      component: RunsList
    },
    // Redirect / errors
    {
      path: '*',
      redirect: '/'
    }
  ],
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { x: 0, y: 0 }
    }
  },
  linkExactActiveClass: 'is-active',
  linkActiveClass: 'is-active'
})
