// import api from '@/services/income/incomeDeviceApi'

const state = () => ({
    openAlarmList: [],
  
    openModal: false,
    
  })

const getters = {}

const mutations = {
  openAddModal(state) {
    state.openModal = true
  },

  openEditModal() {},

  closeModal(state) {
    state.openModal = false
  }
}

const actions = {}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
