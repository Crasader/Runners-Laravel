<template>
  <section class="section homepage">
    <div class="container">

      <div class="columns">

        <div class="column is-half">
          <router-link :to="{ name : 'runs-list'}">
            <div class="notification is-warning">
              <h2 class="title is-2 has-text-centered">Runs</h2>
            </div>
          </router-link>
        </div>

        <div class="column is-half">
          <a href="/chauffeurs">
            <div class="notification is-primary">
              <h2 class="title is-2 has-text-centered">Chauffeurs</h2>
            </div>
          </a>
        </div>

      </div>

      <div class="columns">

        <div class="column is-half">
          <a href="#">
            <div class="notification is-success">
              <h2 class="title is-2 has-text-centered">Véhicules</h2>
            </div>
          </a>
        </div>

        <div class="column is-half">
          <a href="#">
            <div class="notification is-info">
              <h2 class="title is-2 has-text-centered">Stats</h2>
            </div>
          </a>
        </div>

      </div>

    </div>
  </section>
</template>

<script>
export default {
  name: 'HomePage'
}
</script>

<style lang="scss" scoped>
// Global vars
@import "../vars.scss";

h2 {
  padding: 100px 10px;
}
</style>
