import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  REPORT_BY_DURATION: BASE_URL + '/api/report/byDuration'
}

export default {
  getReportByDuration(payload) {
    return axios.post(urls.REPORT_BY_DURATION, payload)
  }
}
