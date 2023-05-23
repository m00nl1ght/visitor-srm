import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@/views/Home.vue'
import LoginPage from '@/views/auth/LoginPage.vue'
import LogoutPage from '@/views/auth/LogoutPage.vue'

import Security from '@/views/Security.vue'
import SecurityCurrentGroup from '@/components/security/CurrentGroup.vue'
import SecurityList from '@/components/security/SecurityList.vue'
import SecurityMainReport from '@/components/reports/SecurityMainReportConnect.js'

import Cars from '@/views/Cars.vue'
import Visitors from '@/views/Visitors.vue'
import Alarms from '@/views/Alarms.vue'
import Events from '@/views/Events.vue'
import Cards from '@/views/Cards.vue'
import Reports from '@/views/Reports.vue'
import ReportOverview from '@/components/reports/ReportOverviewConnect.js'
import ReportAnalitics from '@/components/reports/ReportAnalitics.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    meta: { layout: 'main' },
    // meta: { layout: 'main', auth: true, accessRoles: ['security'] }, пример защиты
    component: Home
  },
  {
    path: '/login',
    name: 'Login',
    meta: { layout: 'empty' },
    component: LoginPage
  },
  {
    path: '/logout',
    name: 'Logout',
    meta: { layout: 'empty' },
    component: LogoutPage
  },
  {
    name: 'Security',
    path: '/security',
    redirect: { name: 'SecurityCurrentGroup' },
    meta: { layout: 'main' },

    component: Security,
    children: [
      {
        name: 'SecurityCurrentGroup',
        path: 'group',
        meta: { layout: 'main' },

        component: SecurityCurrentGroup
      },
      {
        name: 'SecurityList',
        path: 'list',
        component: SecurityList,
        meta: { layout: 'main' }
      },
      {
        name: 'SecurityMainReport',
        path: 'report',
        component: SecurityMainReport,
        meta: { layout: 'main' }
      }
    ]
  },
  {
    path: '/cars',
    name: 'Cars',
    meta: { layout: 'main' },
    // meta: { layout: 'main', auth: true, accessRoles: ['security'] },
    component: Cars
  },
  {
    path: '/visitors',
    name: 'Visitors',
    meta: { layout: 'main' },
    component: Visitors
  },
  {
    path: '/alarms',
    name: 'Alarms',
    meta: { layout: 'main' },
    component: Alarms
  },
  {
    path: '/events',
    name: 'Events',
    meta: { layout: 'main' },
    component: Events
  },
  {
    path: '/cards',
    name: 'Cards',
    meta: { layout: 'main' },
    component: Cards
  },
  {
    path: '/reports',
    name: 'Reports',
    meta: { layout: 'main' },
    component: Reports,
    redirect: { name: 'ReportOverview' },
    children: [
      {
        name: 'ReportOverview',
        path: 'overview',
        meta: { layout: 'main' },
        component: ReportOverview
      },
      {
        name: 'ReportAnalitics',
        path: 'analitics',
        component: ReportAnalitics,
        meta: { layout: 'main' }
      }
    ]
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
