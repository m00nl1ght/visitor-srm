import axios from 'axios'

const urls = {
  VISITOR: '/api/visitor/search-by-surname'
}

export default {
  searchBySurname(payload) {
    return axios.post(urls.VISITOR, payload)
  }
}
