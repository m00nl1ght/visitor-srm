import api from '@/services/securityGroupApi.js'

const state = () => ({
  securityGroupModalOpen: false,

  addModalValue: {
    chief: null,
    operator: null,
    securities: []
  },
  currentGroup: null,

  errorMessage: null
})

const getters = {
  currentGroup: (state) => state.currentGroup,
  securityGroupModalOpen: (state) => state.securityGroupModalOpen,
  addSecurityModalValue: (state) => state.addModalValue,
  getCurrentGroupMembers: (state) => {
    if (state.currentGroup && state.currentGroup.length !== 0) {
      let group = [...state.currentGroup.securities]
      group.push(state.currentGroup.chief)
      group.push(state.currentGroup.operator)
      return group
    } else {
      return null
    }
  },
  getCurrentGroupOperator: (state) => (state.currentGroup && state.currentGroup.length !== 0 ? state.currentGroup.operator : null)
}

const mutations = {
  addGroupModalOpen(state) {
    state.securityGroupModalOpen = true
    state.addModalValue = {
      chief: null,
      operator: null,
      securities: []
    }
  },

  editGroupModalOpen(state, payload) {
    state.securityGroupModalOpen = true
    state.addModalValue = payload
  },

  securityGroupModalClose(state) {
    state.securityGroupModalOpen = false
  },

  addGroup(state, payload) {
    state.currentGroup = payload
  },

  storeError(state, payload) {
    state.errorMessage = payload
  },

  addModalValue(state, { key, value }) {
    state.addModalValue[key] = value
  }
}

const actions = {
  async getCurrentGroup({ commit }, payload) {
    try {
      const { data } = await api.getCurrentGroup(payload)
      commit('addGroup', data.data)
    } catch (error) {
      commit('storeError', payload)
    }
  },

  async addGroup({ commit }, payload) {
    try {
      const { data } = await api.addGroup(payload)
      commit('addGroup', data.data)
      commit('securityGroupModalClose')
    } catch (error) {
      commit('storeError', error)
    }
  },

  async editGroup({ commit }, payload) {
    try {
      const { data } = await api.editGroup(payload)
      commit('addGroup', data.data)
      commit('securityGroupModalClose')
    } catch (error) {
      commit('storeError', error)
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
