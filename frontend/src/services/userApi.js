import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  LOGIN: BASE_URL + '/api/login',
  REQISTRATION: BASE_URL + '/api/registration',
  GET_CURRENT_USER: BASE_URL + '/api/users/get-current',
  GET_USERS_LIST: BASE_URL + '/api/users',
  GET_ROLES_LIST: BASE_URL + '/api/roles',
  ADD_ROLES: BASE_URL + '/api/add-user-roles'
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

  getRolesList () {
    return axios.get(urls.GET_ROLES_LIST)
  },

  addRoles(id, roles) {
    console.log('roles', roles)
    console.log('id', id)
    return axios.post(urls.ADD_ROLES, roles, {params: {id: id}})
  }
}
//axios.post(url, body, {params: { id: id }})