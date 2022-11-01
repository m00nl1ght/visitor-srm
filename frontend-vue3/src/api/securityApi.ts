import axios from "axios"

const urls = {
  SECURITY_ROLES: '/api/security/roles',
  SECURITIES: '/api/securities'
}

interface Security {
  id: string
  lastName: string
  middleName: string
  name: string
  roleSecurityId: number,
  role: Roles
}

interface Roles {
  id: string 
  title: string
  deletion: Number
}

export default {
  getSecurities(): Promise<Security[]> {
    return axios.get(urls.SECURITIES)
  },

  addSecurity(payload: any) {
    return axios.post(urls.SECURITIES, payload)
  },

  editSecurity(payload: any) {
    return axios.put(urls.SECURITIES + `/${payload.id}`, payload)
  },

  deleteSecurity(id: any) {
    return axios.delete(urls.SECURITIES + `/${id}`)
  },

  getSecurityRoles() {
    return axios.get(urls.SECURITY_ROLES)
  },

  addGroup(payload: any) {
    return axios.post(urls.SECURITIES, payload)
  }
}
