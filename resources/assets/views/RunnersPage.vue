<template>
  <div class="runnerspage">
    <div class="section homepage">
      <div class="container">

        <div class="columns">

          <div class="column is-half">
            <a href="#">
              <div class="notification is-warning">
                <h2 class="title is-2 has-text-centered">Tous</h2>
              </div>
            </a>
          </div>

          <div class="column is-half">
            <a href="/chauffeurs">
              <div class="notification is-primary">
                <h2 class="title is-2 has-text-centered">Kiéla?</h2>
              </div>
            </a>
          </div>

        </div>

        <div class="columns">

          <div class="column is-half">
            <a href="#">
              <div class="notification is-success">
                <h2 class="title is-2 has-text-centered">Groupes</h2>
              </div>
            </a>
          </div>

          <div class="column is-half">
            <a href="#">
              <div class="notification is-info">
                <h2 class="title is-2 has-text-centered">Planning</h2>
              </div>
            </a>
          </div>

        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'RunnersPage'
}
</script>

<style lang="scss">
// Global vars
@import "../vars.scss";

h2 {
  padding: 100px 10px;
}
</style>
