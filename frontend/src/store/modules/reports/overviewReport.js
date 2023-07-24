import api from '@/services/reports/reportApi.js'
import apiSecurity from '@/services/reports/securityReportApi.js'

const state = () => ({
  reportByDurationData: {},
  sendedReport: {}
})

const getters = {}

const mutations = {
  storeReportByDuration(state, payload) {
    state.reportByDurationData = payload
  }
}

const actions = {
  async getReportByDuration({ commit }, payload) {
    try {
      const { data } = await api.getReportByDuration(payload)
      commit('storeReportByDuration', data)
    } catch (error) {
      console.log(error)
    }
  },

  async getReportByDay({ commit }, date) {
    try {
      const { data } = await apiSecurity.getReportByDay(date)
      commit('storeReportByDuration', data)
    } catch (error) {
      console.log(error)
    }
  },

  async getSendedReport() {
    try {
      await api.getSendedReport()
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
