import axios from 'axios'

const urls = {
  CARD: '/api/income-foggoten-card'
}

export default {
  getIncomeCardList() {
    return axios.get(urls.CARD)
  },

  addIncomeCard(payload) {
    return axios.post(urls.CARD, payload)
  },

  returnIncomeCard(id) {
    return axios.put(urls.CARD + '/' + id)
  },

  deleteIncomeCard(id) {
    return axios.delete(urls.CARD + '/' + id)
  }
}
