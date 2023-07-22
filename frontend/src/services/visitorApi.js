import axios from 'axios'

const urls = {
  VISITOR: '/api/visitor'
}

export default {
  searchBySurname(payload) {
    return axios.post(urls.VISITOR + '/searchBySurname', payload)
  }
}
