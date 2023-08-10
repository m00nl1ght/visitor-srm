import api from '@/services/income/incomeCarApi'

const state = () => ({
  error: null,

  incomeCarList: [],
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
    car: {
      model: '',
      number: ''
    },

    securityId: null,
    categoryId: null
  }
})

const getters = {}

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
      car: {
        model: '',
        number: ''
      },

      securityId: null,
      categoryId: null
    }
  },

  storeFormVisitor(state, { key, value }) {
    state.formValue.visitor[key] = value
  },

  storeFormEmployee(state, { key, value }) {
    state.formValue.employee[key] = value
  },

  storeFormSecurity(state, value) {
    state.formValue.securityId = value
  },

  storeFormCar(state, { key, value }) {
    state.formValue.car[key] = value
  },

  storeFormCategory(state, value) {
    state.formValue.categoryId = value
  },

  exitCar(state, id) {
    state.incomeCarList = state.incomeCarList.filter((item) => item.id !== id)
  },

  storeImcomeCarList(state, value) {
    state.incomeCarList = value
  },

  addIncomeCar(state, value) {
    state.incomeCarList.push(value)
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

    const car = {
      model: value.car?.carModel?.title,
      number: value.car?.regNumber
    }

    state.formValue = { ...state.formValue, visitor, car }
  }
}

const actions = {
  async getIncomeCarList({ commit }) {
    try {
      const { data } = await api.getIncomeCarList()
      commit('storeImcomeCarList', data)
    } catch (error) {
      commit('storeError', error)
    }
  },

  async registrateNewCar({ state, dispatch, commit }) {
    try {
      const { data } = await api.registrateNewCar(state.formValue)
      commit('addIncomeCar', data)
      commit('closeModal')
      dispatch('accessCard/getCardList', null, { root: true })
    } catch (error) {
      commit('storeError', error)
    }
  },

  async exitCar({ dispatch, commit }, { id, time }) {
    try {
      await api.exitCar({ id, time })
      commit('exitCar', id)
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
