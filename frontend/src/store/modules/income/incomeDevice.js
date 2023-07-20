import api from '@/services/income/incomeDeviceApi'
import api_employee from '@/services/employeeApi'
import { cloneDeep } from 'lodash'

function defaultFormValue() {
  return {
    employeeId: '',
    device: ''
  }
}

const state = () => ({
  networkNameList: [],
  employeeNameList: [],
  listDeviceStatus: [],
  openModal: false,
  formValue: defaultFormValue(),
  statuses: ['approved', 'rejected']

})

const getters = {}

const mutations = {
  openModal(state) {
    state.openModal = true
  },

  openEditModal(state, id) {
    state.formValue = cloneDeep(state.listDeviceStatus.find((item) => item.id === id))
    state.openModal = true
  },

  closeModal(state) {
    state.openModal = false
    state.formValue = defaultFormValue()
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

  changeStatuses (state, value) {
    state.statuses = value
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

  async addDevice({ state, dispatch }) {
    try {
      await api.addDevice(state.formValue)
      dispatch('getListDeviceStatus', state.statuses)
    } catch (error) {
      console.log(error)
    }
  },

  async editDevice({ dispatch, state }) {
    try {
      await api.editDevice(state.formValue)
      dispatch('getListDeviceStatus', state.statuses)
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
