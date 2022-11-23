import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  LOGIN: BASE_URL + '/api/login',
  LOGOUT: BASE_URL + '/api/logout'
}

export default {
  login({ email, password }) {
    return axios.post(urls.LOGIN, { email, password })
  },

  logout() {
    return axios.post(urls.LOGOUT)
  }
}
