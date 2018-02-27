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

          <b-dropdown hoverable>
            <a
              slot="trigger"
              class="navbar-item">
              <span>Runs</span>
              <b-icon icon="chevron-down"/>
            </a>
            <b-dropdown-item>
              Liste des runs
            </b-dropdown-item>
            <hr class="dropdown-divider">
            <b-dropdown-item>
              Créer un run
            </b-dropdown-item>
          </b-dropdown>

          <b-dropdown hoverable>
            <a
              slot="trigger"
              class="navbar-item">
              <span>Véhicules</span>
              <b-icon icon="chevron-down"/>
            </a>
            <b-dropdown-item>
              Créer véhicule
            </b-dropdown-item>
            <hr class="dropdown-divider">
            <b-dropdown-item>
              Créer type de véhicule
            </b-dropdown-item>
          </b-dropdown>

          <b-dropdown hoverable>
            <a
              slot="trigger"
              class="navbar-item">
              <span>Chauffeurs</span>
              <b-icon icon="chevron-down"/>
            </a>
            <b-dropdown-item>
              Liste chauffeurs
            </b-dropdown-item>
            <hr class="dropdown-divider">
            <b-dropdown-item>
              Importer liste chauffeurs
            </b-dropdown-item>
            <b-dropdown-item>
              Créer chaffeur
            </b-dropdown-item>
          </b-dropdown>

          <b-dropdown hoverable>
            <a
              slot="trigger"
              class="navbar-item">
              <span>Groupes</span>
              <b-icon icon="chevron-down"/>
            </a>
            <b-dropdown-item>
              Liste des groupes
            </b-dropdown-item>
            <hr class="dropdown-divider">
            <b-dropdown-item>
              Ajouter groupe
            </b-dropdown-item>
          </b-dropdown>

          <b-dropdown hoverable>
            <a
              slot="trigger"
              class="navbar-item">
              <span>Horaires</span>
              <b-icon icon="chevron-down"/>
            </a>
            <b-dropdown-item>
              Liste des horaires
            </b-dropdown-item>
            <hr class="dropdown-divider">
            <b-dropdown-item>
              Ajouter horaire
            </b-dropdown-item>
          </b-dropdown>

        </div>

        <div class="navbar-end">
          <!-- Authentication Links -->
          <a
            class="navbar-item"
            href="LOGIN">Connexion</a>

          <b-dropdown
            hoverable
            position="is-bottom-left">
            <a
              slot="trigger"
              class="navbar-item">
              <span>Bastien</span>
              <b-icon icon="chevron-down"/>
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
              Profile
            </b-dropdown-item>
            <b-dropdown-item value="logout">
              <b-icon icon="logout"/>
              Déconnexion
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
