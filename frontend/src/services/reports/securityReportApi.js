import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  REPORT_BY_DAY: BASE_URL + '/api/report/byDay',
  REPORT_BY_SECURITY_TEAM: BASE_URL + '/api/security-team-report/by-team'
}

export default {
  getReportByDay(date) {
    return axios.get(urls.REPORT_BY_DAY, {
      params: {
        date
      }
    })
  },

  getReportBySecurityTeam(id) {
    return axios.get(urls.REPORT_BY_SECURITY_TEAM, {
      params: {
        id
      }
    })
  }
}
