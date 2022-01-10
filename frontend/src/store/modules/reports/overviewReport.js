import api from "@/services/reports/reportApi.js"

const state = () => ({
  reportByDurationData: {},
})

const getters = {}

const mutations = {
  storeReportByDuration(state, payload) {
    state.reportByDurationData = payload
  }
}

const actions = {
  async getReportByDuration({ commit }, { start, end }) {
    try {
      const { data } = await api.getReportByDuration({ start, end })
      commit('storeReportByDuration', data.data)
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
