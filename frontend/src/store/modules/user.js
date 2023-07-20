import api from '@/services/userApi.js'

function defaultFormValue() {
  return {
    name: '',
    email: '',
    password: '',
  }
}

const state = () => ({
  error: undefined,
  userList: [],
  rolesList: [],
  currentUser: undefined,
  openModal: false,
  openModalRoles: false,
  formValue: defaultFormValue()
})

const getters = {
  hasAccessRole: (state) => (roles) => {
    if (state.currentUser?.roles?.length > 0) {
      const hasRole = state.currentUser.roles.filter((currRole) => roles.some((role) => role === currRole))
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
  },
  openAddModal(state) {
    state.openModal = true
  },
  openEditModal(state) {
    state.openModal = true
  },
  openEditModalRoles(state) {
    state.openModalRoles = true
  },
  closeModal(state) {
    state.openModal = false
    // state.formValue = defaultFormValue()
  },
  showRolesList(state, roles) {
    state.rolesList = roles 
  }
}

const actions = {

  async registration({ dispatch }, payload) {
    try {
      await api.registration(payload)
      dispatch('getUserList')
    } catch (error) {
      console.log (error)
    }
  },

  async getUserList({ commit }) {
    try {
      const { data } = await api.getUserList()
      commit('storeUserList', data.data)
    } catch (error) {
      commit('storeError', error)
    }
  },

  async getCurrentUser({ commit }) {
    try {
      const { data } = await api.getCurrentUser()
      commit('storeCurrentUser', data.data)
    } catch (error) {
      commit('storeError', error)
    }
  },

  async deleteUser ({dispatch}, id) {
    try {
      await api.deleteUser(id)
      dispatch('getUserList')
    } catch (error) {
      console.log(error)
    }
  },

  async getRolesList ({ commit }) {
    try {
      const { data } = await api.getRolesList()
      commit('showRolesList', data.data)
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
