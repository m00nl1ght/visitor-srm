import Vue from 'vue'
import Vuex from 'vuex'
import globalSnackbar from '@/store/modules/globalSnackbar'
import security from '@/store/modules/securities/security'
import securityGroup from '@/store/modules/securities/securityGroup'
import incomeVisitor from '@/store/modules/income/incomeVisitor'
import incomeCar from '@/store/modules/income/incomeCar'
import incomeAlarm from '@/store/modules/income/incomeAlarm'
import incomeEvent from '@/store/modules/income/incomeEvent'
import incomeCard from '@/store/modules/income/incomeCard'
import accessCard from '@/store/modules/card/accessCard'
import visitorCategory from '@/store/modules/category/visitorCategory'
import systemAlarmCategory from '@/store/modules/category/systemAlarmCategory'
import autoinsert from '@/store/modules/autoinsert.js'

//reports
import securityReport from '@/store/modules/reports/securityReport.js'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    globalSnackbar,
    security,
    securityGroup,
    incomeVisitor,
    incomeCar,
    incomeAlarm,
    incomeEvent,
    incomeCard,
    accessCard,
    visitorCategory,
    systemAlarmCategory,
    autoinsert,
    securityReport
  },
})
