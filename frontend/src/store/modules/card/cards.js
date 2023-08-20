import api from '@/services/cards/cardApi'

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
  },

  addCard(state, card) {
    state.cardList.push(card)
  }
}

const actions = {
  async getCardList({ commit }) {
    try {
      const { data } = await api.getCardList()
      commit('storeCardList', data)
    } catch (error) {
      console.log(error)
    }
  },

  async storeCard({ commit }, payload) {
    try {
      const { data } = await api.storeCard(payload)
      commit('addCard', data)
    } catch (error) {
      console.log(error)
    }
  },

  async updateById(_, { id, data }) {
    try {
      await api.updateById({ id, data })
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
