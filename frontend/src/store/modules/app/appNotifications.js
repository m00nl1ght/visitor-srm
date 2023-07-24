const state = {
  showMessage: false,
  messagesArray: [],
  code: undefined,
  duration: undefined
}

const getters = {}

const mutations = {
  setNotificationMessage(state, message) {
    if (state.showMessage) state.messagesArray.push(message)
    else state.messagesArray = [message]
    state.showMessage = true
  },

  clearNotificationMessage(state) {
    state.showMessage = false
    state.messagesArray = []
    state.code = undefined
    state.duration = undefined
  },

  setCode(state, code) {
    state.code = code
  },

  setDuration(state, payload) {
    state.duration = payload
  }
}

const actions = {
  createNotificationMessage({ commit }, errorData) {
    let errorMessage = ''

    if (errorData?.response?.data?.message) {
      errorMessage = errorData.response.data.message
      if (errorMessage.split(':')[1]) errorMessage = errorMessage.split(':')[1].trim()
    } else {
      errorMessage = errorData.toString()
    }

    commit('setNotificationMessage', errorMessage)
  },

  notifySuccess({ dispatch, commit }, notifyData) {
    commit('setCode', 200)
    commit('setDuration', 2000)
    dispatch('createNotificationMessage', notifyData.text ? notifyData.text : notifyData)
  },

  notifyError({ dispatch, commit }, notifyData) {
    commit('setCode', 500)
    dispatch('createNotificationMessage', notifyData.text ? notifyData.text : notifyData)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
