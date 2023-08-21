import axios from 'axios'

const urls = {
  GET_CARD_CATEGORY: '/api/card-category'
}

export default {
  getCardCategoryList() {
    return axios.get(urls.GET_CARD_CATEGORY)
  }
}
