import Vue from 'vue'
import Vuex from 'vuex'

import appNotifications from '@/store/modules/app/appNotifications.js'
import appProgressBanner from '@/store/modules/app/appProgressBanner.js'

import user from '@/store/modules/user.js'
import auth from '@/store/modules/auth.js'
import globalSnackbar from '@/store/modules/globalSnackbar'
import security from '@/store/modules/securities/security'
import securityGroup from '@/store/modules/securities/securityGroup'
import incomeVisitor from '@/store/modules/income/incomeVisitor'
import incomeCar from '@/store/modules/income/incomeCar'
import incomeAlarm from '@/store/modules/income/incomeAlarm'
import incomeEvent from '@/store/modules/income/incomeEvent'
import incomeDevice from '@/store/modules/income/incomeDevice'
import incomeCard from '@/store/modules/income/incomeCard'
import accessCard from '@/store/modules/card/accessCard'
import visitorCategory from '@/store/modules/category/visitorCategory'
import systemAlarmCategory from '@/store/modules/category/systemAlarmCategory'
import autoinsert from '@/store/modules/autoinsert.js'

//reports
import securityReport from '@/store/modules/reports/securityReport.js'
import overviewReport from '@/store/modules/reports/overviewReport.js'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    appNotifications,
    appProgressBanner,
    user,
    auth,
    globalSnackbar,
    security,
    securityGroup,
    incomeVisitor,
    incomeCar,
    incomeAlarm,
    incomeEvent,
    incomeCard,
    incomeDevice,
    accessCard,
    visitorCategory,
    systemAlarmCategory,
    autoinsert,
    securityReport,
    overviewReport
  }
})
