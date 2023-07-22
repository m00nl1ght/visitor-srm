import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  ON_TERRITORY: BASE_URL + '/api/income-visitor/on-territory',
  OUT: BASE_URL + '/api/incomeVisitor/out',
  IN: BASE_URL + '/api/incomeVisitor/in'
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
