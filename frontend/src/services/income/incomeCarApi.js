import axios from 'axios'

const urls = {
  ON_TERRITORY: '/api/incomeCar/onTerritory',
  OUT: '/api/incomeCar/out',
  IN: '/api/incomeCar/in'
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
