import api from '@/services/income/incomeCardApi'

function defaultFormValue() {
  return {
    employee: {
      lastName: '',
      name: '',
      middleName: '',
      position: ''
    },

    boss: {
      lastName: '',
      name: '',
      middleName: '',
      position: ''
    },
    cardId: null
  }
}

const state = () => ({
  incomeCardList: [],
  autoinsertList: [],

  openModal: false,
  formValue: defaultFormValue()
})

const getters = {}

const mutations = {
  storeIncomeCardList(state, payload) {
    state.incomeCardList = payload
  },

  openAddModal(state) {
    state.openModal = true
  },

  closeModal(state) {
    state.openModal = false
    state.formValue = defaultFormValue()
  },

  setEmployeeFormValue(state, payload) {
    state.formValue.employee[payload.key] = payload.value
  },

  setBossFormValue(state, payload) {
    state.formValue.boss[payload.key] = payload.value
  },

  setCardIdFormValue(state, id) {
    state.formValue.cardId = id
  },

  setAutoinsertEmployee(state, payload) {
    if (payload && payload.lastName) state.formValue.employee.lastName = payload.lastName
    if (payload && payload.name) state.formValue.employee.name = payload.name
    if (payload && payload.middleName) state.formValue.employee.middleName = payload.middleName
    if (payload && payload.position && typeof payload.position == 'object') state.formValue.employee.position = payload.position.position
    if (payload && payload.position && typeof payload.position == 'string') state.formValue.employee.position = payload.position
  },

  setAutoinsertBoss(state, payload) {
    if (payload && payload.lastName) state.formValue.boss.lastName = payload.lastName
    if (payload && payload.name) state.formValue.boss.name = payload.name
    if (payload && payload.middleName) state.formValue.boss.middleName = payload.middleName
    if (payload && payload.position && typeof payload.position == 'object') state.formValue.boss.position = payload.position.position
    if (payload && payload.position && typeof payload.position == 'string') state.formValue.boss.position = payload.position
  },

  setClearAutoinsert(state) {
    state.autoinsertList = []
  }
}

const actions = {
  async getIncomeCardList({ commit }) {
    try {
      const { data } = await api.getIncomeCardList()
      commit('storeIncomeCardList', data)
    } catch (error) {
      console.log(error)
    }
  },

  async addIncomeCard({ state, commit, dispatch }) {
    try {
      await api.addIncomeCard(state.formValue)
      dispatch('getIncomeCardList')
      dispatch('cards/getCardList', null, { root: true })
      commit('closeModal')
    } catch (error) {
      console.log(error)
    }
  },

  async returnIncomeCard({ dispatch }, id) {
    try {
      await api.returnIncomeCard(id)
      await dispatch('getIncomeCardList')
      dispatch('cards/getCardList', null, { root: true })
    } catch (error) {
      console.log(error)
    }
  },

  async deleteIncomeCard({ dispatch }, id) {
    try {
      await api.deleteIncomeCard(id)
      await dispatch('getIncomeCardList')
      dispatch('cards/getCardList', null, { root: true })
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
