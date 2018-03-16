<script>
/**
 * LoginForm
 *
 * A little authentication form (used in the navbar)
 *
 * @author Bastien Nicoud
 */

// Module to map the vue x actions in component methods
import { mapActions } from 'vuex'

// Export the component
export default {
  name: 'LoginForm',
  data () {
    return {
      user: {
        email: '',
        password: '',
        remember: ''
      }
    }
  },
  methods: {
    ...mapActions('user', [
      'login'
    ])
  }
}
</script>

<template>
  <form class="loginform">
    <div
      class="modal-card"
      style="width:300px;">

      <section class="modal-card-body">

        <!-- EMAIL field -->
        <b-field label="Email">
          <b-input
            v-model="user.email"
            type="email"
            placeholder="Your email"
            required/>
        </b-field>

        <!-- PASSWORD field -->
        <b-field label="Password">
          <b-input
            v-model="user.password"
            type="password"
            password-reveal
            placeholder="Your password"
            required/>
        </b-field>

        <!-- Remember checkbox -->
        <b-checkbox v-model="user.remember">Remember me</b-checkbox>

      </section>

      <footer class="modal-card-foot">
        <button
          type="submit"
          class="button is-primary"
          @click.prevent="login(user)">
          Login
        </button>
      </footer>

    </div>
  </form>
</template>
