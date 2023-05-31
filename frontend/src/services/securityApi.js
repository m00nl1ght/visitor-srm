import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  SECURITY_ROLES: BASE_URL + '/api/security/roles',
  SECURITIES: BASE_URL + '/api/securities'
}

export default {
  getSecurities() {
    return axios.get(urls.SECURITIES)
  },

  addSecurity(payload) {
    return axios.post(urls.SECURITIES, payload)
  },

  editSecurity(payload) {
    return axios.put(urls.SECURITIES + `/${payload.id}`, payload)
  },

  deleteSecurity(id) {
    return axios.delete(urls.SECURITIES + `/${id}`)
  },

  getSecurityRoles() {
    return axios.get(urls.SECURITY_ROLES)
  },

  addGroup(payload) {
    return axios.post(urls.SECURITIES, payload)
  }
}
