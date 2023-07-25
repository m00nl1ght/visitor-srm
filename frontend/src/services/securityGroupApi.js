import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  SECURITY_GROUP: BASE_URL + '/api/security-team'
}

export default {
  getCurrentGroup() {
    return axios.get(urls.SECURITY_GROUP + '/last')
  },

  addGroup(payload) {
    return axios.post(urls.SECURITY_GROUP, payload)
  },

  editGroup({ data, id }) {
    return axios.put(urls.SECURITY_GROUP + `/${id}`, data)
  }
}
