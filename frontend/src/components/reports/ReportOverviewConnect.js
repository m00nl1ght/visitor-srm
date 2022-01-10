import { connect } from 'vuex-connect'
import ReportOverview from './ReportOverview.vue'

export default connect({
  stateToProps: {
    reportData: (state) => state.overviewReport.reportByDurationData
  },

  lifecycle: {
    mounted: ({ dispatch }) => {
      dispatch('overviewReport/getReportByDuration', { start: '2021-03-10', end: '2021-03-11' })
    }
  }
})('ReportOverview', ReportOverview)
