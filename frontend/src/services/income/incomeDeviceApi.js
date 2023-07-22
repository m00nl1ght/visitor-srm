import axios from 'axios'

// import { deviceList } from './mockDevice.js'

const urls = {
  GET_DEVICE: '/api/device/getNetworkName',
  GET_DEVICE_DATA: '/api/device/getNetworkNameData',
  GET_NAME_EMPLOYEE: '/api/employee',
  REG_DEVICE: '/api/device-permission',
  GET_LIST_DEVICE_STATUS: '/api/device-permission/get-by-statuses',
  CHANGE_STATUS: '/api/device-permission/change-status'
}

export default {
  //получение списка компов для регистрации
  getNetworkNameList() {
    return axios.get(urls.GET_DEVICE)
  },
  //получение списка сотрудников для регистрации
  getNameEmployee() {
    return axios.get(urls.GET_NAME_EMPLOYEE)
  },
  //регистрация разрешения
  addDevice(payload) {
    return axios.post(urls.REG_DEVICE, payload)
  },

  editDevice(payload) {
    return axios.put(urls.REG_DEVICE + '/' + payload.id, payload)
  },

  getListDeviceStatus(statuses) {
    return axios.post(urls.GET_LIST_DEVICE_STATUS, { statuses })
  },

  changeStatus(payload) {
    return axios.post(urls.CHANGE_STATUS, payload)
  }
}
