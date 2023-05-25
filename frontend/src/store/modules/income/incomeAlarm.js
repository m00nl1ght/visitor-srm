import api from '@/services/income/incomeAlarmApi'
import { cloneDeep } from 'lodash'

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
  formValue: defaultFormValue(),
  formValueEdit: defaultFormValue(),
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
    state.formValue = state.openAlarmList.find((item) => item.id == id),
    state.formValueEdit = cloneDeep(state.formValue),
    state.openModal = true
  },

  closeModal(state) {
    state.openModal = false
    state.formValue = defaultFormValue()
  },

  completedAlarm(state, index) {
    const completedAlarmId = state.openAlarmList.findIndex((item) => item.id === index)
    state.openAlarmList.splice(completedAlarmId, 1)
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

  async registrateAlarm({ state, commit }) {
    try {
      if (state.formValueEdit.id) {
        const { data } = await api.editAlarm(state.formValueEdit)
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
      const { data } = await api.closeAlarm(id)
      commit('completedAlarm', data.data.id)
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
