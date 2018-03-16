<script>
/**
 * NavBar
 *
 * The top navbar of the app
 *
 * @author Bastien Nicoud
 */

// Child components import
import LoginForm from './LoginForm'

// Exports the component
export default {
  name: 'NavBar',
  components: { LoginForm }
}
</script>

<template>
  <nav class="navbar is-light">
    <div class="container">

      <!-- Left side of the nav, always shown -->
      <div class="navbar-brand">
        <router-link
          :to="{ name : 'home-page' }"
          class="navbar-item">
          <img
            src="/img/logo.svg"
            alt="Runners logo"
            width="112"
            height="28">
        </router-link>
        <div
          class="navbar-burger burger"
          data-target="navbarExampleTransparentExample">
          <span/>
          <span/>
          <span/>
        </div>
      </div>

      <!-- The navbar menu -->
      <div class="navbar-menu">

        <!-- Left side of the menu -->
        <div class="navbar-start">

          <b-dropdown hoverable>
            <router-link
              slot="trigger"
              :to="{ name : 'runs-list' }"
              class="navbar-link navbar-item">
              <span>Runs</span>
            </router-link>
            <b-dropdown-item has-link>
              <router-link :to="{ name : 'runs-list' }">
                Liste des runs
              </router-link>
            </b-dropdown-item>
            <hr class="dropdown-divider">
            <b-dropdown-item>
              Créer un run
            </b-dropdown-item>
          </b-dropdown>

          <b-dropdown hoverable>
            <a
              slot="trigger"
              class="navbar-link navbar-item">
              <span>Véhicules</span>
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
              class="navbar-link navbar-item">
              <span>Chauffeurs</span>
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
              class="navbar-link navbar-item">
              <span>Groupes</span>
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
              class="navbar-link navbar-item">
              <span>Horaires</span>
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

        <!-- Right side of the menu -->
        <div class="navbar-end">

          <!-- Connexion dropdown -->
          <b-dropdown position="is-bottom-left">
            <a
              slot="trigger"
              class="navbar-item navbar-link">
              <span>Connexion</span>
            </a>

            <b-dropdown-item
              custom
              paddingless>

              <!-- The form for authenticating in the app -->
              <login-form/>

            </b-dropdown-item>
          </b-dropdown>

          <!-- Dropdown with the infos for connected user -->
          <b-dropdown
            hoverable
            position="is-bottom-left">
            <a
              slot="trigger"
              class="navbar-link navbar-item">
              <span>Bastien</span>
            </a>

            <!-- Connected user infos -->
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
              disabled>
              <b-icon icon="book-open"/>
              Securité
            </b-dropdown-item>

            <hr class="dropdown-divider">

            <!-- Connected user links -->
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
