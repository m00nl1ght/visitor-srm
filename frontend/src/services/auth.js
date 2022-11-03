import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  LOGIN: BASE_URL + '/api/login'
}

export default {
  login({ email, password }) {
    return axios.post(urls.LOGIN, { email, password })
  }
}
