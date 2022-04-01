import { BASE_URL } from "@/config.js"
import axios from "axios"

const urls = {
  LOGIN: BASE_URL + '/api/login',
  REQISTRATION: BASE_URL + '/api/registration',
  GET_CURRENT_USER: BASE_URL + '/api/get-current-user',
  GET_USERS_LIST: BASE_URL + '/api/user/list',
}

export default {
  login(payload) {
    return axios.post(urls.LOGIN, payload)
  },

  registration(payload) {
    return axios.post(urls.REQISTRATION, payload)
  },

  getCurrentUser() {
    return axios.get(urls.GET_CURRENT_USER)
  },

  getCurrentUser() {
    return axios.get(urls.GET_USERS_LIST)
  }
}