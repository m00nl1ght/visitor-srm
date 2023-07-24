import axios from 'axios'

const urls = {
  SEARCH_BY_NAME: '/api/employee/search-by-surname',
  GET_NAME_EMPLOYEE: '/api/employee'
}

export default {
  searchBySurname(payload) {
    return axios.post(urls.SEARCH_BY_NAME, payload)
  },

  getNameEmployee() {
    return axios.get(urls.GET_NAME_EMPLOYEE)
  }
}
