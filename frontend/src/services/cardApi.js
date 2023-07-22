import axios from 'axios'

const urls = {
  GET_CARD: '/api/card/index'
}

export default {
  getCardList() {
    return axios.get(urls.GET_CARD)
  }
}
