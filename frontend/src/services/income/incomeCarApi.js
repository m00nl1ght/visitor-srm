import { BASE_URL } from "@/config.js"
import axios from "axios"

const urls = {
  ON_TERRITORY: BASE_URL + '/api/incomeCar/onTerritory',
  OUT: BASE_URL + '/api/incomeCar/out',
  IN: BASE_URL + '/api/incomeCar/in',
}

export default {
  getIncomeCarList() {
    return axios.get(urls.ON_TERRITORY)
  },

  registrateNewCar(payload) {
    return axios.post(urls.IN, payload)
  },

  exitCar({id, time}) {
    return axios.post(urls.OUT, {id, outTime: time})
  }
}
