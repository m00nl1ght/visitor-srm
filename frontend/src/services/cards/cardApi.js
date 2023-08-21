import axios from 'axios'

const urls = {
  GET_CARD: '/api/card'
}

export default {
  getCardList() {
    return axios.get(urls.GET_CARD)
  },

  storeCard(payload) {
    return axios.post(urls.GET_CARD, payload)
  },

  updateById({ data, id }) {
    return axios.put(urls.GET_CARD + `/${id}`, data)
  }
}
