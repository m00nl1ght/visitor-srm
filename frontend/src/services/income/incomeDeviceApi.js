import { BASE_URL } from '@/config'
import axios from 'axios'

const urls = {
  GET_DEVICE: BASE_URL + '/api/device/getNetworkName',
  GET_DEVICE_DATA: BASE_URL + '/api/device/getNetworkNameData',
  GET_NAME_EMPLOYEE: BASE_URL + '/api/employee',
}

export default {
  getNetworkNameList() {
    return axios.get(urls.GET_DEVICE)
  },

  getNetworkNameDataList(networkNameData) {
    return axios.get(urls.GET_DEVICE_DATA, networkNameData)
  },

  getNameEmployee() {
    return axios.get(urls.GET_NAME_EMPLOYEE)
  },

  // registrateDevice(payload) {
  //     return axios.post(urls.'', payload)
  // }
}
