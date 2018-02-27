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

<script>
import NavBar from './components/Navigation/NavBar'
import RunnersFooter from './components/RunnersFooter'

export default {
  name: 'App',
  components: { NavBar, RunnersFooter }
}
</script>

<style lang="scss">
// Import the global app style
@import './main.scss';

</style>
