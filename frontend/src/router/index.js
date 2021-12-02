import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@/views/Home.vue'

import Security from '@/views/Security.vue'
import SecurityCurrentGroup from '@/components/security/CurrentGroup.vue'
import SecurityList from '@/components/security/SecurityList.vue'
import SecurityMainReport from '@/components/reports/SecurityMainReport.vue'

import Cars from '@/views/Cars.vue'
import Visitors from '@/views/Visitors.vue'
import Alarms from '@/views/Alarms.vue'
import Events from '@/views/Events.vue'
import Cards from '@/views/Cards.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    meta: {layout: 'main'},
    component: Home
  },
  {
    name: 'Security',
    path: '/security',
    redirect: { name: 'SecurityCurrentGroup'},
    meta: {layout: 'main'},
    component: Security,
    children: [
      {
        name: 'SecurityCurrentGroup',
        path: 'group',
        meta: {layout: 'main'},
        component: SecurityCurrentGroup
      },
      {
        name: "SecurityList",
        path: 'list',
        component: SecurityList,
        meta: {layout: 'main'},
      },
      {
        name: "SecurityMainReport",
        path: 'report',
        component: SecurityMainReport,
        meta: {layout: 'main'},
      }
    ]
  },
  {
    path: '/cars',
    name: 'Cars',
    meta: {layout: 'main'},
    component: Cars
  },
  {
    path: '/visitors',
    name: 'Visitors',
    meta: {layout: 'main'},
    component: Visitors
  },
  {
    path: '/alarms',
    name: 'Alarms',
    meta: {layout: 'main'},
    component: Alarms
  },
  {
    path: '/events',
    name: 'Events',
    meta: {layout: 'main'},
    component: Events
  },
  {
    path: '/cards',
    name: 'Cards',
    meta: {layout: 'main'},
    component: Cards
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
