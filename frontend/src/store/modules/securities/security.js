import api from "@/services/securityApi"

const state = () => ({
  securities: [],
  securityRoles: [],

  securityModalOpen: false,
  addFormValue: {
    name: '',
    lastName: '',
    middleName: '',
    roleSecurityId: 3
  },

  errorMessage: null
})

const getters = {
  securities: state => state.securities,
  securityRoles: state => state.securityRoles,
  securityModalOpen: state => state.securityModalOpen,
  addFormValue: state => state.addFormValue
}

const mutations = {
  storeError(state, payload) {
    state.errorMessage = payload
  },

  storeSecurities(state, payload) {
    state.securities = payload
  },

  storeEditSecurities(state, payload) {
    state.securities = state.securities.map(item => {
      if(item.id == payload.id) {
        return payload
      }
      return item
    })
  },

  storeAddSecurity(state, payload) {
    state.securities.push(payload)
  },

  deleteSecurity(state, id) {
    state.securities = state.securities.filter(item => item.id !== id)
  },

  setSecurityModalOpen(state, payload) {
    state.securityModalOpen = payload
  },

  setAddFormValue(state, {value, key}) {
    state.addFormValue[key] = value
  },

  initAddFormValue(state, payload) {
    state.addFormValue = {
      id: payload.id,
      name: payload.name,
      lastName: payload.lastName,
      middleName: payload.middleName,
      roleSecurityId: payload.role.id
    }
  },

  resetAddFormValue(state) {
    state.addFormValue = {
      name: '',
      lastName: '',
      middleName: '',
      roleSecurityId: 3
    }
  },

  storeSecurityRoles(state, payload) {
    state.securityRoles = payload
  }
}

const actions = {
  async getSecurities({commit}) {
    try {
      const {data} = await api.getSecurities()
      commit('storeSecurities', data.data)
    } catch (error) {
      commit('storeError', error)
    }
  },

  async addSecurity({state, commit}) {
    try {
      if(state.addFormValue.id) {
        const { data } = await api.editSecurity(state.addFormValue)
        commit('storeEditSecurities', data.data)
      } else {
        const { data } = await api.addSecurity(state.addFormValue)
        commit('storeAddSecurity', data.data)
      }
      
      commit('setSecurityModalOpen', false)
    } catch (error) {
      console.log(error);
      commit('storeError', error)
    }
  },

  async deleteSecurity({ commit }, id) {
    try {
      await api.deleteSecurity(id)
      commit('deleteSecurity', id)
    } catch (error) {
      console.log(error);
      commit('storeError', error)
    }
  },

  async getSecurityRoles({commit}) {
    try {
      const { data } = await api.getSecurityRoles()
      commit('storeSecurityRoles', data.data)
    } catch (error) {
      console.log(error);
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