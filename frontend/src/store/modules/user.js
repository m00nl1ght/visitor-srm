import api from '@/services/userApi.js'

const state = () => ({
  error: undefined,
  userList: []
})

const getters = {}

const mutations = {
  storeError(state, payload) {
    state.error = payload
  },
  storeUserList(state, payload) {
    state.userList = payload
  }
}

const actions = {
  async getUserList({ commit }) {
    try {
      const { data } = await api.getUserList()
      commit('storeUserList', data.data)
    } catch (error) {
      commit('storeError', payload)
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
