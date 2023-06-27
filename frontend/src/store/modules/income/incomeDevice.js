import api from '@/services/income/incomeDeviceApi'
import api_employee from '@/services/employeeApi'

const state = () => ({
  networkNameList: {},
  employeeNameList: {},
  openDeviceList: [],
  // formValue: {
  //   networkName: '',
  //   id: ''
  // },
  openModal: false
})

const getters = {
  getOpenModal: (state) => state.openModal,
  getFormValue: (state) => state.formValue
}

const mutations = {
  openModal(state) {
    state.openModal = true
  },

  openEditModal() {},

  closeModal(state) {
    state.openModal = false
  },

  storeNetworkNameList(state, value) {
    state.networkNameList = value
  },

  storeNameEmployee(state, value) {
    state.employeeNameList = value
    console.log('employeeNameList', state.employeeNameList)
  },

  storeDeviceList(state, value) {
    state.openDeviceList = value
  }
}

const actions = {
  async getNetworkNameList({ commit }) {
    try {
      const { data } = await api.getNetworkNameList()
      commit('storeNetworkNameList', data.data)
    } catch (error) {
      console.log(error)
    }
  },

  async getNameEmployee({ commit }) {
    try {
      const { data } = await api_employee.getNameEmployee()

      commit('storeNameEmployee', data.data)
    } catch (error) {
      console.log(error)
    }
  },

  async registrateDevice(_, regDevice) {
    try {
      await api.addDevice(regDevice)
    } catch (error) {
      console.log(error)
    }
  },

  async getDeviceList({ commit }) {
    try {
      const { data } = await api.getDeviceList()
      commit('storeDeviceList', data.data)
    } catch (error) {
      console.log (error)
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
