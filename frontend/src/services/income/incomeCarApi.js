import axios from 'axios'

const urls = {
  ON_TERRITORY: '/api/income-car/on-territory',
  OUT: '/api/income-car/leave-territory',
  IN: '/api/income-car/enter-territory'
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
