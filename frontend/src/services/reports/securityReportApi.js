import axios from 'axios'

const urls = {
  REPORT_BY_DAY: '/api/report/byDay',
  REPORT_BY_SECURITY_TEAM: '/api/security-team-report/by-team'
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
