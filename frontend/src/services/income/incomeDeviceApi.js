import { BASE_URL } from '@/config'
import axios from 'axios'

const urls = {
  GET_DEVICE: BASE_URL + '/api/device/getNetworkName',
  GET_DEVICE_DATA: BASE_URL + '/api/device/getNetworkNameData',
  GET_NAME_EMPLOYEE: BASE_URL + '/api/employee',
  REG_DEVICE: BASE_URL + '/api/device-permission',
  GET_DEVICE_LIST: BASE_URL + '/api/device-permission'
}

export default {
  getNetworkNameList() {
    return axios.get(urls.GET_DEVICE)
  },

  getNetworkNameDataList(networkName) {
    return axios.get(urls.GET_DEVICE_DATA, networkName)
  },

  getNameEmployee() {
    return axios.get(urls.GET_NAME_EMPLOYEE)
  },

  addDevice(regDevice) {
    return axios.post(urls.REG_DEVICE, regDevice)
  },

  getDeviceList() {
    return axios.get(urls.GET_DEVICE_LIST)
  }

  
}
