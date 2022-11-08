import api from '@/services/userApi.js'

const state = () => ({
  error: undefined,
  userList: [],
  currentUser: undefined
})

const getters = {
  hasAccessRole: state => roles => {
    if (state.currentUser?.roles?.length > 0) {
      const hasRole = state.currentUser.roles.filter(currRole => roles.some(role => role === currRole))
      return hasRole && hasRole.length > 0
    } else return false
  }
}

const mutations = {
  storeError(state, payload) {
    state.error = payload
  },
  storeUserList(state, payload) {
    state.userList = payload
  },
  storeCurrentUser(state, payload) {
    state.currentUser = payload
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
  },

  async getCurrentUser({ commit }) {
    try {
      const { data } = await api.getCurrentUser()
      commit('storeCurrentUser', data.data)
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
