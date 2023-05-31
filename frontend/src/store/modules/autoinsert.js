import employeeApi from '@/services/employeeApi.js'
import visitorApi from '@/services/visitorApi.js'

const state = () => ({
  autoinsertEmployeeList: [],
  autoinsertVisitorList: []
})

const getters = {}

const mutations = {
  setAutoinsertEmployeeList(state, payload) {
    state.autoinsertEmployeeList = payload
  },
  setAutoinsertVisitorList(state, payload) {
    state.autoinsertVisitorList = payload
  }
}

const actions = {
  async getEmployeeForAutoinsert({ commit }, payload) {
    try {
      const { data } = await employeeApi.searchBySurname({ lastName: payload })
      commit('setAutoinsertEmployeeList', data.data)
    } catch (error) {
      console.log(error)
    }
  },

  async getVisitorForAutoinsert({ commit }, payload) {
    try {
      const { data } = await visitorApi.searchBySurname({ lastName: payload })
      commit('setAutoinsertVisitorList', data.data)
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
