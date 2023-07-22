import axios from 'axios'

const urls = {
  EMPLOYEE: '/api/employee',
  GET_NAME_EMPLOYEE: '/api/employee'
}

export default {
  searchBySurname(payload) {
    return axios.post(urls.EMPLOYEE + '/searchBySurname', payload)
  },

  getNameEmployee() {
    return axios.get(urls.GET_NAME_EMPLOYEE)
  }
}
