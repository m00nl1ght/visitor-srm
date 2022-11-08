import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import VueHtmlToPaper from 'vue-html-to-paper'
import moment from 'moment'
import axios from 'axios'
import { BASE_URL } from './config.js'

import '@/globalRouterHooks'

const VueHtmlToPaperOptions = {
  name: '_blank',
  specs: ['fullscreen=yes', 'titlebar=yes', 'scrollbars=yes'],
  styles: [`${BASE_URL}/styles/print_card.css`],
  timeout: 1000, // default timeout before the print window appears
  autoClose: false, // if false, the window will not close after printing
  windowTitle: window.document.title // override the window title
}

Vue.use(VueHtmlToPaper, VueHtmlToPaperOptions)
Vue.config.productionTip = false
Vue.prototype.$moment = moment

async function createApp() {
  // const reqs = []
  // await store.dispatch("fetchCurrentCompanySubdomain");
  // reqs.push(store.dispatch('fetchServers'))
  // reqs.push(store.dispatch(FETCH_USER_SESSION_NAME_ACT))
  // await Promise.all(reqs)

  // const AUTH_TOKEN = '8|ZFhptoKtKH4xfRzFFwnl7YuMFApJdJhpEpz1XSES'
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
    render: h => h(App)
  }).$mount('#app')
}

createApp()
