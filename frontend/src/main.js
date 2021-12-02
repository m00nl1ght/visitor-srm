import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import VueHtmlToPaper from 'vue-html-to-paper';
import moment from 'moment';
import { BASE_URL } from './config.js'

const VueHtmlToPaperOptions = {
  name: '_blank',
  specs: [
    'fullscreen=yes',
    'titlebar=yes',
    'scrollbars=yes'
  ],
  styles: [
    `${ BASE_URL }/styles/print_card.css`
  ],
  timeout: 1000, // default timeout before the print window appears
  autoClose: false, // if false, the window will not close after printing
  windowTitle: window.document.title, // override the window title
}

Vue.use(VueHtmlToPaper, VueHtmlToPaperOptions);
Vue.config.productionTip = false
Vue.prototype.$moment = moment;

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
