import router from '@/router'
import store from '@/store'

router.beforeEach((to, from, next) => {
  if (to.meta.auth && store.getters['auth/isLoggedIn']) {
    const accessRoles = to.meta.accessRoles
    if (accessRoles && accessRoles.length > 0 && store.getters['user/hasAccessRole'](accessRoles)) {
      next()
      return
    } else {
      next('/login')
    }
  } else {
    next()
  }
})
