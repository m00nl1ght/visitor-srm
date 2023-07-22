import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import VueHtmlToPaper from 'vue-html-to-paper'
import moment from 'moment'
import axios from 'axios'
import { logoutPage } from '@/router/names/index.js'

import '@/globalRouterHooks'

const VueHtmlToPaperOptions = {
  name: '_blank',
  specs: ['fullscreen=yes', 'titlebar=yes', 'scrollbars=yes'],
  styles: [`${process.env.VUE_APP_DEV_BACKEND_URL}/styles/print_card.css`],
  timeout: 1000, // default timeout before the print window appears
  autoClose: false, // if false, the window will not close after printing
  windowTitle: window.document.title // override the window title
}

Vue.use(VueHtmlToPaper, VueHtmlToPaperOptions)
Vue.config.productionTip = false
Vue.prototype.$moment = moment

async function createApp() {
  // const AUTH_TOKEN = '8|ZFhptoKtKH4xfRzFFwnl7YuMFApJdJhpEpz1XSES'

  if (process.env.NODE_ENV !== 'production') {
    //   axios.defaults.withCredentials = true
    axios.defaults.baseURL = process.env.VUE_APP_DEV_BACKEND_URL
  }

  axios.interceptors.response.use(
    function (response) {
      return response // Any status code that lie within the range of 2xx cause this function to trigger. Do something with response data
    },
    function (error) {
      // Any status codes that falls outside the range of 2xx cause this function to trigger. Do something with response error
      if (error?.response?.status === 401) router.push({ name: logoutPage })
      else if (error?.response?.status === 403) return Promise.reject('ACCESS_DENIED')
      else return Promise.reject(error)
    }
  )

  const AUTH_TOKEN = localStorage.getItem('token')
  if (AUTH_TOKEN) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${AUTH_TOKEN}`
    store.commit('auth/setToken', AUTH_TOKEN)
    await store.dispatch('user/getCurrentUser')
  }

  new Vue({
    router,
    store,
    vuetify,
    render: (h) => h(App)
  }).$mount('#app')
}

createApp()
