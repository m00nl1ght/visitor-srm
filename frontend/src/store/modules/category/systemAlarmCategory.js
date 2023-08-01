import api from '@/services/categoryApi'

const state = () => ({
  systemAlarmList: []
})

const getters = {}

const mutations = {
  storeSystemAlarmList(state, payload) {
    state.systemAlarmList = payload
  }
}

const actions = {
  async getSystemAlarmList({ commit }) {
    try {
      const { data } = await api.getSystemAlarmList()
      commit('storeSystemAlarmList', data.data)
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
