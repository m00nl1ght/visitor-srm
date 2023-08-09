import EditUsersPage from '@/views/admin/editUsers/EditUsersPage.vue'

import * as names from '../names/index.js'
import * as paths from '../paths/index.js'

const routes = [
  {
    path: paths.adminEditUsersPage,
    name: names.adminEditUsersPage,
    meta: { layout: 'main' },
    component: EditUsersPage
  }
]

export default routes
