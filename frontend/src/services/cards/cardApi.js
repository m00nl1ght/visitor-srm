import axios from 'axios'

const urls = {
  GET_CARD: '/api/card'
}

export default {
  getCardList() {
    return axios.get(urls.GET_CARD)
  },

  addCard({ number, cardCategoryId }) {
    return axios.get(urls.GET_CARD, { number, cardCategoryId })
  },

  updateById({ data, id }) {
    return axios.put(urls.GET_CARD + `/${id}`, data)
  }
}
