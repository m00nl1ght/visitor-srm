import { BASE_URL } from "@/config.js"
import axios from "axios"

const urls = {
  EMPLOYEE: BASE_URL + '/api/employee',
}

export default {
  searchBySurname(payload) {
    return axios.post(urls.EMPLOYEE + '/searchBySurname', payload)
  }
}
