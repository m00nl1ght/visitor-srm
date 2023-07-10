import api from '@/services/income/incomeDeviceApi'
import api_employee from '@/services/employeeApi'
import { cloneDeep } from 'lodash'

const state = () => ({
  networkNameList: [],
  employeeNameList: [],
  listDeviceStatus: [],
  formValue: {
    device: '',
    employee: {
      id: ''
    }
  },
  openModal: false
})

const getters = {}

const mutations = {
  openModal(state) {
    state.openModal = true
  },

  openEditModal(state, id) {
    state.formValue = cloneDeep(state.listDeviceStatus.find((item) => item.id === id))
    state.openModal = true
    console.log('formValue', state.formValue)
  },

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
      // if (state.formValue.id) {
      //   const { data } = await api.editDevice()
      // } else 
        const { data } = await api.addDevice(regDevice)
        console.log ('data', data.data)
      
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

  async changeStatus(_, { id, status, callback }) {
    try {
      await api.changeStatus({ id, status })
      callback()
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
