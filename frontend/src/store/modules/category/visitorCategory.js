import api from "@/services/categoryApi"

const state = () => ({
  categoryList: []
})

const getters = {
  getCategoryList: state => state.categoryList
}

const mutations = {
  storeCategoryList(state, payload) {
    state.categoryList = payload
  }
}

const actions = {
  async getCategoryList({ state, commit }) {
    try {
      if(state.categoryList.length == 0) {
        const { data } = await api.getCategoryList()
        commit('storeCategoryList', data.data)
      }
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