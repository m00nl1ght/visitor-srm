import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  ACTIVE_GROUP: BASE_URL + '/api/security-team/active',
  ADD_GROUP: BASE_URL + '/api/security-team',
  EDIT_GROUP: BASE_URL + '/api/security-team'
}

export default {
  getCurrentGroup() {
    return axios.get(urls.ACTIVE_GROUP)
  },

  addGroup(payload) {
    return axios.post(urls.ADD_GROUP, payload)
  },

  editGroup({ data, id }) {
    return axios.put(urls.EDIT_GROUP + `/${id}`, data)
  }
}
