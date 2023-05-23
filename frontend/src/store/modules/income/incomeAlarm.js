import api from '@/services/income/incomeAlarmApi'

function defaultFormValue() {
  return {
    title: '',
    place: '',
    comment: '',
    systemAlarmListId: 1
  }
}

const state = () => ({
  openAlarmList: [],

  openModal: false,
  
  formValue: defaultFormValue()
})

const getters = {}

const mutations = {
  storeOpenAlarmList(state, payload) {
    state.openAlarmList = payload
  },

  openAddModal(state) {
    state.openModal = true
  },

  openEditModal(state, id) {
    state.formValue = state.openAlarmList.find((item) => item.id == id)
    state.openModal = true
  },

  closeModal(state) {
    state.openModal = false
    state.formValue = defaultFormValue()
  },
  completedAlarm(state, index) {
    const completedAlarmId = state.openAlarmList.findIndex((item) => item.id === index)
    state.openAlarmList.splice(completedAlarmId, 1)
    console.log('completedAlarmId', completedAlarmId)
  }
}

const actions = {
  async getOpenAlarmList({ commit }) {
    try {
      const { data } = await api.getOpenAlarmList()
      commit('storeOpenAlarmList', data.data)
    } catch (error) {
      console.log(error)
    }
  },

  async viewAlarm({ state, commit }) {
    try {
      const { data } = await api.viewAlarmApi(state.formValue)
      commit('storeOpenAlarmList', data.data)
    } catch (error) {
      console.log(error)
    }
  },

  async registrateAlarm({ state, commit }) {
    try {
      if (state.formValue.id) {
        const { data } = await api.editAlarm(state.formValue)
        commit('storeOpenAlarmList', data.data)
      } else {
        const { data } = await api.addAlarm(state.formValue)
        commit('storeOpenAlarmList', data.data)
      }

      commit('closeModal')
    } catch (error) {
      console.log(error)
    }
  },

  async deleteAlarm({ commit }, id) {
    try {
      const { data } = await api.deleteAlarm(id)
      commit('storeOpenAlarmList', data.data)
    } catch (error) {
      console.log(error)
    }
  },
  async closeAlarm({ commit }, id) {
    try {
      console.log('id closeAlarm', id)
      const { data } = await api.closeAlarm(id)
      commit('completedAlarm', data.data.id)
      console.log('data.data.id', data.data.id)
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
