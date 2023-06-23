import api from '@/services/income/incomeDeviceApi'

const state = () => ({
  networkNameList: {},

  formValue: {
    device: {
      networkName: '',
    },
    employee: {
      name: '',
      lastName: '',
      middleName: ''
    }
  },
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
    console.log ('list NN2222', state.networkNameList)
  }
  
}

const actions = {
  async getNetworkNameList ( { commit } ) {
    try {
      const { data } = await api.getNetworkNameList()
      console.log('action listNN', data)
      commit('storeNetworkNameList', data.data)
      
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
