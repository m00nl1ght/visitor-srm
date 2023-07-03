import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  EMPLOYEE: BASE_URL + '/api/employee',
  GET_NAME_EMPLOYEE: BASE_URL + '/api/employee',
}

export default {
  searchBySurname(payload) {
    return axios.post(urls.EMPLOYEE + '/searchBySurname', payload)
  },

  getNameEmployee() {
    return axios.get(urls.GET_NAME_EMPLOYEE)
  },
}
