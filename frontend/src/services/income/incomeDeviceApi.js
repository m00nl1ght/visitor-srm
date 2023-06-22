import { BASE_URL } from "@/config";
import axios from 'axios'

const urls = {
    GET_DEVICE: BASE_URL + '/api/device/getNetworkName',
    GET_DEVICE_DATA: BASE_URL + '/api/device/getNetworkNameData'
}

export default {
    getNetworkName(networkName) {
        return axios.get(urls.GET_DEVICE, networkName)
    },

    getNetworkNameData(networkNameData) {
        return axios.get(urls.GET_DEVICE_DATA, networkNameData)
    },

    registrateDevice(payload) {
        // return axios.post(urls.'', payload)
    }
}