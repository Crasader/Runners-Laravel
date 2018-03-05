<template>
  <form class="loginform">
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
        <button
          class="button is-primary"
          @click="login()">
          Login
        </button>
      </footer>
    </div>
  </form>
</template>

<script>
import { mapActions } from 'vuex'

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
