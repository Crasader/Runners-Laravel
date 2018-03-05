/*
 |--------------------------------------------------------------------------
 | User store module
 |--------------------------------------------------------------------------
 |
 | Here we describe the user part of the store
 | This store is imported in the global store as a module
 | @author Bastien Nicoud
 |
 */

export default {
  namespaced: true,
  state: {
    username: '',
    firstname: '',
    lastname: '',
    role: 'guest',
    permissions: {
      start_run: false,
      end_run: false,
      force_start_run: false,
      force_end_run: false,
      create_runners: false,
      create_coordinators: false,
      create_admin: false,
      destroy_runners: false,
      destroy_coordinators: false,
      destroy_admin: false
    }
  },
  getters: {
    fullName: state => {
      return `${state.firstname} ${state.lastname}`
    }
  },
  mutations: {
    SET_USER (state, user) {
      state = user
    }
  },
  actions: {
    login ({ state, commit, rootState }) {
      console.log('tutu')
    },
    fetchUser ({ state, commit, rootState }) {
      //
    }
  }
}
