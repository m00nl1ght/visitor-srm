import axios from 'axios'

const urls = {
  ACTIVE_GROUP: '/api/security-team/active',
  ADD_GROUP: '/api/security-team',
  EDIT_GROUP: '/api/security-team'
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
