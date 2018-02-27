/*
 |--------------------------------------------------------------------------
 | Base routes
 |--------------------------------------------------------------------------
 |
 | Register global routes for the app (homepage...)
 | @author Bastien Nicoud
 |
 */

// Conponents imports
import HomePage from '../views/HomePage.vue'

// Routes declarations
export default [
  // Homepage
  {
    path: '/',
    name: 'home-page',
    component: HomePage
  }
]
