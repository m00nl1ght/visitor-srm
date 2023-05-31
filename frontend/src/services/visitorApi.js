import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  VISITOR: BASE_URL + '/api/visitor'
}

export default {
  searchBySurname(payload) {
    return axios.post(urls.VISITOR + '/searchBySurname', payload)
  }
}
