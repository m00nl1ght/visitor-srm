import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  REPORT_BY_DURATION: BASE_URL + '/api/report/byDuration',
  SEND_REPORT: BASE_URL + '/api/report/send-security-team-report'
}

export default {
  getReportByDuration(payload) {
    return axios.post(urls.REPORT_BY_DURATION, payload)
  },

  getSendedReport () {
    return axios.get(urls.SEND_REPORT)
  }
}
