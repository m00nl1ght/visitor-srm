import api from '@/services/cards/cardCategoryApi'

const state = () => ({
  cardCategoryList: []
})

const getters = {}

const mutations = {
  storeCardCategoryList(state, payload) {
    state.cardCategoryList = payload
  }
}

const actions = {
  async getCardCategoryList({ commit }) {
    try {
      const { data } = await api.getCardCategoryList()
      commit('storeCardCategoryList', data)
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
