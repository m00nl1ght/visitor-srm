import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  GET_CARD: BASE_URL + '/api/card/index'
}

export default {
  getCardList() {
    return axios.get(urls.GET_CARD)
  }
}
