<template>
  <nav class="navbar is-light">
    <div class="container">

      <div class="navbar-brand">
        <a
          class="navbar-item"
          href="/">
          <img
            src="/img/logo.svg"
            alt="Bulma: a modern CSS framework based on Flexbox"
            width="112"
            height="28">
        </a>
        <div
          class="navbar-burger burger"
          data-target="navbarExampleTransparentExample">
          <span/>
          <span/>
          <span/>
        </div>
      </div>

      <div class="navbar-menu">

        <div class="navbar-start">
          <div class="navbar-item has-dropdown is-hoverable">
            <a
              class="navbar-link"
              href="/runs">
              Runs
            </a>
            <div class="navbar-dropdown is-boxed">
              <a
                class="navbar-item"
                href="/runs/create">
                Créer run
              </a>
            </div>
          </div>
          <div class="navbar-item has-dropdown is-hoverable">
            <a
              class="navbar-link"
              href="/vehicules">
              Véhicules
            </a>
            <div class="navbar-dropdown is-boxed">
              <a
                class="navbar-item"
                href="/vehicule/create">
                Créer véhicule
              </a>
              <hr class="navbar-divider">
              <a
                class="navbar-item"
                href="/vehicule/create">
                Créer type de véhicule
              </a>
            </div>
          </div>
          <div class="navbar-item has-dropdown is-hoverable">
            <a
              class="navbar-link"
              href="/chauffeurs">
              Chauffeurs
            </a>
            <div class="navbar-dropdown is-boxed">
              <a
                class="navbar-item"
                href="/chauffeurs/create">
                Créer chauffeurs
              </a>
            </div>
          </div>
          <a
            class="navbar-item"
            href="/groupes">
            Groupes
          </a>
          <a
            class="navbar-item"
            href="/horaires">
            Horaires
          </a>
        </div>

        <div class="navbar-end">
          <!-- Authentication Links -->
          <a
            class="navbar-item"
            href="LOGIN">Login</a>
          <a
            class="navbar-item"
            href="REGISTER">Register</a>
          <b-dropdown position="is-bottom-left">
            <a
              slot="trigger"
              class="navbar-item">
              <span>Menu</span>
              <b-icon icon="menu-down"/>
            </a>

            <b-dropdown-item custom>
              Logged as <b>Rafael Beraldo</b>
            </b-dropdown-item>
            <hr class="dropdown-divider">
            <b-dropdown-item has-link>
              <a
                href="https://google.com"
                target="_blank">
                <b-icon icon="link"/>
                Google (link)
              </a>
            </b-dropdown-item>
            <b-dropdown-item value="home">
              <b-icon icon="home"/>
              Home
            </b-dropdown-item>
            <b-dropdown-item value="products">
              <b-icon icon="cart"/>
              Products
            </b-dropdown-item>
            <b-dropdown-item
              value="blog"
              disabled>
              <b-icon icon="book-open"/>
              Blog
            </b-dropdown-item>
            <hr class="dropdown-divider">
            <b-dropdown-item value="settings">
              <b-icon icon="settings"/>
              Settings
            </b-dropdown-item>
            <b-dropdown-item value="logout">
              <b-icon icon="logout"/>
              Logout
            </b-dropdown-item>
          </b-dropdown>
        </div>

      </div>

    </div>
  </nav>
</template>

<script>
export default {
  name: 'NavBar'
}
</script>

<style lang="scss">
// Import the global app style
@import '../../main.scss';

</style>
