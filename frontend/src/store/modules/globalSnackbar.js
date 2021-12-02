const state = () => ({
  main: {
    message: '',
    isOpen: false,
    timeout: 3000
  }

})

const getters = {
  mainSnackbar: state => state.main
}

const mutations = {
  setOpenMainSnackbar(state, payload) {
    state.main = {
      message: payload.message,
      isOpen: true,
      timeout: payload.timeout ? payload.timeout : 3000
    }
  },

  setCloseMainSnackbar(state) {
    state.main.isOpen = false
  }
}

const actions = {

}
export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}