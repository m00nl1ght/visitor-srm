import { connect } from 'vuex-connect'
import moment from 'moment'

import SecurityMainReport from './SecurityMainReport.vue'

export default connect({
  stateToProps: {
    reportData: (state) => state.securityReport.reportBySecurityTeamData
  },

  lifecycle: {
    mounted: ({ dispatch }) => {
      dispatch('securityReport/getReportBySecurityTeam', moment(new Date()).subtract(1, 'd').format('YYYY-MM-DD'))
    }
  }
})('SecurityMainReport', SecurityMainReport)
