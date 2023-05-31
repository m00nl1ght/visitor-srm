import api from '@/services/reports/securityReportApi.js'

const state = () => ({
  reportByDayData: {},
  reportBySecurityTeamData: {}
})

const getters = {}

const mutations = {
  storeReportByDay(state, payload) {
    state.reportByDayData = payload
  },

  storeReportBySecurityTeam(state, payload) {
    state.reportBySecurityTeamData = payload
  }
}

const actions = {
  async getReportByDay({ commit }, date) {
    try {
      const { data } = await api.getReportByDay(date)
      commit('storeReportByDay', data.data)
    } catch (error) {
      console.log(error)
    }
  },

  async getReportBySecurityTeam({ commit }, date) {
    try {
      const { data } = await api.getReportBySecurityTeam(date)
      commit('storeReportBySecurityTeam', data.data)
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
