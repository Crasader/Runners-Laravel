import Vue from 'vue'
import Router from 'vue-router'
// import { resolve } from 'path';

// import HomePage from '../components/HomePage.vue'
import SecondPage from '../components/SecondPage.vue'
// const HomePage = () => import('../components/HomePage.vue').then(m => m.default)
// const Foo = () => import('./Foo.vue')

Vue.use(Router)

export default new Router({
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
