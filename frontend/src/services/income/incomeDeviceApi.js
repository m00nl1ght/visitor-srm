import { BASE_URL } from '@/config'
import axios from 'axios'

const urls = {
  GET_DEVICE: BASE_URL + '/api/device/getNetworkName',
  GET_DEVICE_DATA: BASE_URL + '/api/device/getNetworkNameData',
  GET_NAME_EMPLOYEE: BASE_URL + '/api/employee',
  REG_DEVICE: BASE_URL + '/api/device-permission',
  GET_DEVICE_LIST: BASE_URL + '/api/device-permission',
  GET_LIST_DEVICE_STATUS: BASE_URL +'/api/device-permission/get-by-statuses'
}

export default {
  //получение списка компов для регистрации
  getNetworkNameList() {
    return axios.get(urls.GET_DEVICE)
  },

  getNetworkNameDataList(list) {
    return axios.get(urls.GET_DEVICE_DATA, {list})
  },
  //получение списка сотрудников для регистрации
  getNameEmployee() {
    return axios.get(urls.GET_NAME_EMPLOYEE)
  },
  //регистрация разрешения
  addDevice(regDevice) {
    return axios.post(urls.REG_DEVICE, regDevice)
  },

  getListDeviceStatus(statuses) {
    return axios.post(urls.GET_LIST_DEVICE_STATUS, {statuses})
    //{statuses: statuses}
  }

  
}
