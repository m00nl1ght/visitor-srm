import AdminPage from '@/views/AdminPage.vue'

import * as names from '../names/index.js'
import * as paths from '../paths/index.js'

const routes = [
  {
    path: paths.adminPage,
    name: names.adminPage,
    meta: { layout: 'main' },
    component: AdminPage
  }
]

export default routes
