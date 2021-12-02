import api from "@/services/income/incomeVisitorApi"

const state = () => ({
  error: null,

  incomeVisitorList: [],
  openModal: false,
  formValue: {
    visitor: {
      name: '',
      lastName: '',
      middleName: '',
      phone: '',
      firm: ''
    },
    employee: {
      name: '',
      lastName: '',
      middleName: ''
    },

    securityId: null,
    cardId: null,
    categoryId: null
  }
})

const getters = {
  getIncomeVisitorList: state => state.incomeVisitorList,
  getOpenModal: state => state.openModal,
  getFormValue: state => state.formValue
}

const mutations = {
  storeError(state, payload) {
    state.error = payload
  },

  openModal(state) {
    state.openModal = true
  },

  closeModal(state) {
    state.openModal = false
    state.formValue = {
      visitor: {
        name: '',
        lastName: '',
        middleName: '',
        phone: '',
        firm: ''
      },
      employee: {
        name: '',
        lastName: '',
        middleName: ''
      },
  
      securityId: null,
      cardId: null,
      categoryId: null
    } 
  },

  storeFormVisitor(state, {key, value}) {
    state.formValue.visitor[key] = value
  },

  storeFormEmployee( state, {key, value}) {
    state.formValue.employee[key] = value
  },

  storeFormSecurity( state, value) {
    state.formValue.securityId = value
  },

  storeFormCard( state, value) {
    state.formValue.cardId = value
  },

  storeFormCategory( state, value) {
    state.formValue.categoryId = value
  },

  exitVisitor( state, id) {
    state.incomeVisitorList = state.incomeVisitorList.filter(item => item.id !== id)
  },

  storeImcomeVisitorList( state, value) {
    state.incomeVisitorList = value
  },

  addIncomeVisitor(state, value) {
    state.incomeVisitorList.push(value)
  },

  autoinsertEmployee(state, value) {
    state.formValue.employee = value
  },

  autoinsertVisitor(state, value) {
    const visitor = {
      name: value.name,
      lastName: value.lastName,
      middleName: value.middleName,
      phone: value.phone,
      firm: value.firm.title
    }

    state.formValue.visitor = { ...visitor }
  }
}

const actions = {
  async getIncomeVisitorList({ commit }) {
    try {
      const { data } = await api.getIncomeVisitorList()
      commit('storeImcomeVisitorList', data.data)
    } catch (error) {
      commit('storeError', error)
    }
  },

  async registrateNewVisitor({ state, dispatch, commit }) {
    try {
      const { data } = await api.registrateNewVisitor(state.formValue)
      commit('addIncomeVisitor', data.data)
      commit('closeModal')
      dispatch('accessCard/getCardList', null, {root: true})
    } catch (error) {
      
    }
  },

  async exitVisitor({dispatch, commit}, {id, time}) {
    try {
      await api.exitVisitor({id, time})
      commit('exitVisitor', id)
      dispatch('accessCard/getCardList', null, { root: true })
    } catch (error) {
      commit('storeError', error)
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