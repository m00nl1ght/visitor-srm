import { connect } from 'vuex-connect'
import ReportOverview from './ReportOverview.vue'

export default connect({
  stateToProps: {
    reportData: (state) => state.overviewReport.reportByDurationData
  },

  methodsToEvents: {
    async getReportByDuration({ dispatch }, payload, callback) {
      await dispatch('overviewReport/getReportByDuration', payload)
      callback()
    },

    async getReportByDay({ dispatch }, payload, callback) {
      await dispatch('overviewReport/getReportByDay', payload)
      callback()
    }
  }
})('ReportOverview', ReportOverview)
