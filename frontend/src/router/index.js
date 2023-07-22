import Vue from 'vue'
import VueRouter from 'vue-router'

import adminRoutes from './routes/adminRoutes.js'
import * as names from './names/index.js'
import * as paths from './paths/index.js'

import Home from '@/views/HomePage.vue'
import LoginPage from '@/views/auth/LoginPage.vue'
import LogoutPage from '@/views/auth/LogoutPage.vue'

import Security from '@/views/security/SecurityPage.vue'
import SecurityCurrentGroup from '@/views/security/components/CurrentGroup.vue'
import SecurityList from '@/views/security/components/SecurityList.vue'
import SecurityMainReport from '@/components/reports/SecurityMainReport.vue'

import Cars from '@/views/CarsPage.vue'
import Visitors from '@/views/VisitorsPage.vue'
import Alarms from '@/views/AlarmsPage.vue'
import Events from '@/views/EventsPage.vue'
import Cards from '@/views/CardsPage.vue'
import Reports from '@/views/ReportsPage.vue'
import ReportOverview from '@/components/reports/ReportOverview.vue'
import ReportAnalitics from '@/components/reports/ReportAnalitics.vue'
import Devices from '@/views/DevicesPage.vue'

Vue.use(VueRouter)

const routes = [
  ...adminRoutes,
  {
    path: paths.homePage,
    name: names.homePage,
    meta: { layout: 'main' },
    // meta: { layout: 'main', auth: true, accessRoles: ['security'] }, пример защиты
    component: Home
  },
  {
    path: paths.loginPage,
    name: names.loginPage,
    meta: { layout: 'empty' },
    component: LoginPage
  },
  {
    path: paths.logoutPage,
    name: names.logoutPage,
    meta: { layout: 'empty' },
    component: LogoutPage
  },
  {
    name: names.securityPage,
    path: paths.securityPage,
    redirect: { name: names.securityCurrentGroup },
    meta: { layout: 'main' },
    component: Security,
    children: [
      {
        name: names.securityCurrentGroup,
        path: paths.securityCurrentGroup,
        meta: { layout: 'main' },
        component: SecurityCurrentGroup
      },
      {
        name: names.securityList,
        path: paths.securityList,
        component: SecurityList,
        meta: { layout: 'main' }
      },
      {
        name: names.securityMainReport,
        path: paths.securityMainReport,
        component: SecurityMainReport,
        meta: { layout: 'main' }
      }
    ]
  },
  {
    path: paths.carsPage,
    name: names.carsPage,
    meta: { layout: 'main' },
    component: Cars
  },
  {
    path: paths.visitorsPage,
    name: names.visitorsPage,
    meta: { layout: 'main' },
    component: Visitors
  },
  {
    path: paths.alarmsPage,
    name: names.alarmsPage,
    meta: { layout: 'main' },
    component: Alarms
  },
  {
    path: paths.eventsPage,
    name: names.eventsPage,
    meta: { layout: 'main' },
    component: Events
  },
  {
    path: paths.cardsPage,
    name: names.cardsPage,
    meta: { layout: 'main' },
    component: Cards
  },
  {
    path: paths.reportsPage,
    name: names.reportsPage,
    meta: { layout: 'main' },
    component: Reports,
    redirect: { name: names.reportOverviewPage },
    children: [
      {
        name: names.reportOverviewPage,
        path: paths.reportOverviewPage,
        meta: { layout: 'main' },
        component: ReportOverview
      },
      {
        name: names.reportAnaliticsPage,
        path: paths.reportAnaliticsPage,
        component: ReportAnalitics,
        meta: { layout: 'main' }
      }
    ]
  },
  {
    path: paths.devicesPage,
    name: names.devicesPage,
    meta: { layout: 'main' },
    component: Devices
  }
]

const router = new VueRouter({
  mode: 'history',
  // eslint-disable-next-line
  base: process.env.BASE_URL,
  routes
})

export default router
