import router from '@/router'
import store from '@/store'

router.beforeEach((to, from, next) => {
  if (to.meta.auth) {
    if (store.getters['auth/isLoggedIn']) {
      const accessRoles = Array.isArray(to.meta.accessRoles) ? to.meta.accessRoles : [to.meta.accessRoles]

      if (!accessRoles || store.getters['user/isAdmin'] || store.getters['user/hasAccessRole'](accessRoles)) {
        next()
        return
      }
    }

    next('/login')
  } else {
    next()
  }
})
