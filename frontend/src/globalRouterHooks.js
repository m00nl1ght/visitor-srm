import router from '@/router'
import store from '@/store'

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // установка заголовка
    // if (to.meta && to.meta.title) {
    //   document.title = `Единый личный кабинет - ${to.meta.title}`;
    // }
    if (store.getters.isLoggedIn) {
      next()
      return
    }
    next('/login')
  } else {
    next()
  }
})
