import api from '@/services/cardApi'

const state = () => ({
  cardList: []
})

const getters = {
  getFreeVisitorCard: (state) => state.cardList.filter((item) => item.cardCategory.title == 'visitor' && !item.issued),
  getFreeEmployeeCard: (state) => state.cardList.filter((item) => item.cardCategory.title == 'employee' && !item.issued)
}

const mutations = {
  storeCardList(state, payload) {
    state.cardList = payload
  }
}

const actions = {
  async getCardList({ commit }) {
    try {
      const { data } = await api.getCardList()
      commit('storeCardList', data.data)
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
