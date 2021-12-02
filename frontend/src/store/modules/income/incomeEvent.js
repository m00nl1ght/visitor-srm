import api from "@/services/income/incomeEventApi"

function defaultFormValue() {
  return {
    description: '',
    comment: '',
    inTime: ''
  }
}

const state = () => ({
  openEventList: [],

  openModal: false,
  formValue: defaultFormValue()
})

const getters = {

}

const mutations = {
  storeOpenEventList(state, payload) {
    state.openEventList = payload
  },

  storeNewEvent(state, event) {
    state.openEventList.push(event)
  },

  storeEditEvent(state, event) {
    state.openEventList = state.openEventList.map(item => {
      if(item.id == event.id) return event
      return item
    })
  },

  openAddModal(state) {
    state.openModal = true
  },

  openEditModal(state, id) {
    state.formValue = state.openEventList.find(item => item.id == id)
    state.openModal = true
  },

  closeModal(state) {
    state.openModal = false
    state.formValue = defaultFormValue()
  }
}

const actions = {
  async getOpenEventList({ commit }) {
    try {
      const { data } = await api.getOpenEventList()
      commit('storeOpenEventList', data.data)
    } catch (error) {
      console.log(error)
    }
  },

  async registrateEvent({ state, commit }) {
    try {
      if(state.formValue.id) {
        const { data } = await api.editEvent(state.formValue)
        commit('storeEditEvent', data.data)
      } else {
        const { data } = await api.addEvent(state.formValue)
        commit('storeNewEvent', data.data)
      }

      commit('closeModal')
    } catch (error) {
      console.log(error)
    }
  },

  async deleteEvent({ commit }, id) {
    try {
      const { data } = await api.deleteAlarm(id)
      commit('storeOpenEventList', data.data)
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