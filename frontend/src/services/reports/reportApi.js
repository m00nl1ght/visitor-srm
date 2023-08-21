import axios from 'axios'

const urls = {
  SEND_REPORT: '/api/security-team-report/send-security-team-report'
}

export default {
  
  getSendedReport() {
    return axios.get(urls.SEND_REPORT)
  }
}
