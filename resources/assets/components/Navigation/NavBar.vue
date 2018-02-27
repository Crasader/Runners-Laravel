<template>
  <nav class="navbar is-light">
    <div class="container">

      <div class="navbar-brand">
        <router-link
          :to="{ name : 'home-page' }"
          class="navbar-item">
          <img
            src="/img/logo.svg"
            alt="Bulma: a modern CSS framework based on Flexbox"
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

      <div class="navbar-menu">

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
              <form action="">
                <div
                  class="modal-card"
                  style="width:300px;">
                  <section class="modal-card-body">
                    <b-field label="Email">
                      <b-input
                        v-model="user.email"
                        type="email"
                        placeholder="Your email"
                        required/>
                    </b-field>

                    <b-field label="Password">
                      <b-input
                        v-model="user.password"
                        type="password"
                        password-reveal
                        placeholder="Your password"
                        required/>
                    </b-field>

                    <b-checkbox v-model="user.remember">Remember me</b-checkbox>
                  </section>
                  <footer class="modal-card-foot">
                    <button class="button is-primary">Login</button>
                  </footer>
                </div>
              </form>
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
  name: 'NavBar',
  data () {
    return {
      user: {
        email: '',
        password: '',
        remember: ''
      }
    }
  }
}
</script>

<style lang="scss">
// Import the global app style
@import '../../main.scss';

</style>
