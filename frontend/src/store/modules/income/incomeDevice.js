import api from '@/services/income/incomeDeviceApi'
import api_employee from '@/services/employeeApi'

const state = () => ({
  networkNameList: {},
  employeeNameList: {},
  listDeviceStatus: {},
  fullListdevice: {},
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

  listDeviceStatus(state, value) {
    state.listDeviceStatus = value
  },

  storeFullInfoDevice(state, value) {
    state.fullListdevice = value
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

  async getListDeviceStatus({ commit }, statuses) {
    try {
      const { data } = await api.getListDeviceStatus(statuses)
      commit('listDeviceStatus', data.data)
    } catch (error) {
      console.log(error)
    }
  },

  async getNetworkNameDataList({ commit }, list) {
    try {
      const { data } = await api.getNetworkNameDataList(list)
      commit('storeFullInfoDevice', data.data)
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
