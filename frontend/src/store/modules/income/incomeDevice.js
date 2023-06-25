import api from '@/services/income/incomeDeviceApi'

const state = () => ({
  networkNameList: {},
  employeeNameList: {},
  formValue: {
    device: {
      networkName: ''
    },
    employee: {
      lastName: '',
      name: '',
      middleName: ''
    }
  },
  openModal: false
})

const getters = {
  getOpenModal: (state) => state.openModal,
  getFormValue: (state) => state.formValue,
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
      const { data } = await api.getNameEmployee()

      commit('storeNameEmployee', data.data)
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
