<script>
/**
 * App
 *
 * The root component of the app
 *
 * @author Bastien Nicoud
 */

// Import the base sub components
import NavBar from './components/Navigation/NavBar'
import RunnersFooter from './components/RunnersFooter'

// Component export
export default {
  name: 'App',
  components: { NavBar, RunnersFooter }
}
</script>

<template>
  <div id="app">
    <!-- Navication component -->
    <nav-bar/>

    <!-- The route view (binded by the router) -->
    <transition
      name="fade"
      mode="out-in">
      <router-view/>
    </transition>

    <!-- Footer component -->
    <runners-footer/>
  </div>
</template>
