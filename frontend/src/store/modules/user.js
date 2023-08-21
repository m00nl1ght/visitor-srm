import api from '@/services/userApi.js'

function defaultFormValue() {
  return {
    name: '',
    email: '',
    password: ''
  }
}

const state = () => ({
  error: undefined,
  userList: [],
  rolesList: [],
  currentUser: undefined,
  openModal: false,
  openModalRoles: false,
  formValue: defaultFormValue(),
  userId: '',
  roles: []
})

const getters = {
  hasAccessRole: (state) => (roles) => {
    if (state.currentUser?.roles?.length > 0) {
      const hasRole = state.currentUser.roles.filter((currRole) => roles.some((role) => role === currRole))
      return hasRole && hasRole.length > 0
    } else return false
  },

  isAdmin: (state) => state.currentUser?.roles?.length > 0 && state.currentUser.roles.find((role) => role === 'admin'),
  isSecurityChief: (state) => state.currentUser?.roles?.length > 0 && state.currentUser.roles.find((role) => role === 'security_chief')
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
  openEditModalRoles(state, item) {
    state.openModalRoles = true
    state.roles = item.role
    state.userId = item.id
  },
  closeModal(state) {
    state.openModal = false
  },
  closeModalRoles(state) {
    state.openModalRoles = false
    state.userId = ''
    state.roles = []
  },
  showRolesList(state, roles) {
    state.rolesList = roles
  },
  currentUserRoles(state, value) {
    state.roles = value
  }
}

const actions = {
  async registration({ dispatch }, payload) {
    try {
      await api.registration(payload)
      dispatch('getUserList')
    } catch (error) {
      console.log(error)
    }
  },

  async getUserList({ commit }) {
    try {
      const { data } = await api.getUserList()
      commit('storeUserList', data)
    } catch (error) {
      commit('storeError', error)
    }
  },

  async getCurrentUser({ commit }) {
    try {
      const { data } = await api.getCurrentUser()
      commit('storeCurrentUser', data)
    } catch (error) {
      commit('storeError', error)
    }
  },

  async deleteUser({ dispatch }, id) {
    try {
      await api.deleteUser(id)
      dispatch('getUserList')
    } catch (error) {
      console.log(error)
    }
  },

  async getRolesList({ commit }) {
    try {
      const { data } = await api.getRolesList()
      commit('showRolesList', data)
    } catch (error) {
      console.log(error)
    }
  },

  async addRoles({ dispatch, commit, state }) {
    try {
      let arrayRoles = []
      for (let i = 0; i < state.roles.length; i++) {
        arrayRoles.push(state.roles[i].id)
      }
      await api.addRoles(state.userId, arrayRoles)
      dispatch('getUserList')
      commit('closeModalRoles')
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
