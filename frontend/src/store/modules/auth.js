import api from '@/services/auth.js'
import axios from 'axios'

const state = () => ({
  authToken: undefined
})

const getters = {
  isLoggedIn: state => !!state.authToken
}

const mutations = {
  setToken(state, payload) {
    state.authToken = payload
  }
}

const actions = {
  async login({ commit }, payload) {
    try {
      const { data } = await api.login(payload)
      const token = data.data
      localStorage.setItem('token', token)
      commit('setToken', token)
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
      return { success: true }
    } catch (error) {
      console.log(error)
      return { success: false }
    }
  },

  async logout({ commit, state }) {
    try {
      console.log('logout')
      await api.logout(state.authToken)
      localStorage.removeItem('token')
      axios.defaults.headers.common['Authorization'] = ''
      commit('setToken', undefined)
    } catch (error) {
      console.log(error)
    }
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
