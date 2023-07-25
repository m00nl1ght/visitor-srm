import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  ON_TERRITORY: BASE_URL + '/api/income-car/on-territory',
  OUT: BASE_URL + '/api/income-car/leave-territory',
  IN: BASE_URL + '/api/income-car/enter-territory'
}

export default {
  getIncomeCarList() {
    return axios.get(urls.ON_TERRITORY)
  },

  registrateNewCar(payload) {
    return axios.post(urls.IN, payload)
  },

  exitCar({ id, time }) {
    return axios.post(urls.OUT, { id, outTime: time })
  }
}
