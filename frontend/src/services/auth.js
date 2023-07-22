import axios from 'axios'

const urls = {
  LOGIN: '/api/login',
  LOGOUT: '/api/logout'
}

export default {
  login({ email, password }) {
    return axios.post(urls.LOGIN, { email, password })
  },

  logout() {
    return axios.post(urls.LOGOUT)
  }
}
