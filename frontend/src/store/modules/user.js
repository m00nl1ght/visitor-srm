import api from '@/services/userApi.js'
import { cloneDeep } from 'lodash'

function defaultFormValue() {
  return {
    name: '',
    email: '',
    password: '',
  }
}

function defaultFormRoles() {
  return {
    role: [
      {
        title: ''
      }
    ]
      
    
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
  formRoles: defaultFormRoles(),
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
  openEditModalRoles(state, id) {
    state.formRoles = cloneDeep(state.userList.find((item) => item.id === id))
    state.openModalRoles = true
    console.log('state', state.formRoles)
  },
  closeModal(state) {
    state.openModal = false
    // state.formValue = defaultFormValue()
  },
  closeModalRoles(state) {
    state.openModalRoles = false 
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
