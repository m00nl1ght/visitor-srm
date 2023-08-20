import AdminPage from '@/views/admin/AdminPage.vue'
import EditUsersPage from '@/views/admin/editUsers/EditUsersPage.vue'
import EditCardsPage from '@/views/admin/editCards/EditCardsPage.vue'

import * as names from '../names/index.js'
import * as paths from '../paths/index.js'

const routes = [
  {
    name: names.adminPage,
    path: paths.adminPage,
    redirect: { name: names.adminEditUsersPage },
    meta: { layout: 'main' },
    component: AdminPage,
    children: [
      {
        path: paths.adminEditUsersPage,
        name: names.adminEditUsersPage,
        meta: { layout: 'main' },
        component: EditUsersPage
      },
      {
        name: names.adminEditCardsPage,
        path: paths.adminEditCardsPage,
        component: EditCardsPage,
        meta: { layout: 'main' }
      }
    ]
  }
]

export default routes
