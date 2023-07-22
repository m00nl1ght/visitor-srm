import axios from 'axios'

const urls = {
  ON_TERRITORY: '/api/income-visitor/on-territory',
  OUT: '/api/income-visitor/leave-territory',
  IN: '/api/income-visitor/enter-territory'
}

export default {
  getIncomeVisitorList() {
    return axios.get(urls.ON_TERRITORY)
  },

  registrateNewVisitor(payload) {
    return axios.post(urls.IN, payload)
  },

  exitVisitor({ id, time }) {
    return axios.post(urls.OUT, { id, outTime: time })
  }
}
