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
import SecondPage from '../components/SecondPage.vue'

// Initialize the router
Vue.use(Router)

// Create and export the router
export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home-page',
      component: resolve => require(['../components/HomePage.vue'], resolve)
    },
    {
      path: '/second',
      name: 'second-page',
      component: SecondPage
    },
    {
      path: '*',
      redirect: '/'
    }
  ]
})
