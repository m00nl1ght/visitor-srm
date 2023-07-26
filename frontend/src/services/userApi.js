import axios from 'axios'

const urls = {
  LOGIN: '/api/login',
  REQISTRATION: '/api/registration',
  GET_CURRENT_USER: '/api/users/get-current',
  GET_USERS_LIST: '/api/users',
  GET_ROLES_LIST: '/api/roles',
  ADD_ROLES: '/api/users/add-user-roles'
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

  getUserList() {
    return axios.get(urls.GET_USERS_LIST)
  },

  deleteUser(id) {
    return axios.delete(urls.GET_USERS_LIST + '/' + id)
  },

  getRolesList() {
    return axios.get(urls.GET_ROLES_LIST)
  },

  addRoles(id, roles) {
    return axios.post(urls.ADD_ROLES, { roles }, { params: { id: id } })
  }
}
