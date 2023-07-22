import axios from 'axios'

const urls = {
  REPORT_BY_DURATION: '/api/report/byDuration',
  SEND_REPORT: '/api/report/send-security-team-report'
}

export default {
  getReportByDuration(payload) {
    return axios.post(urls.REPORT_BY_DURATION, payload)
  },

  getSendedReport() {
    return axios.get(urls.SEND_REPORT)
  }
}
