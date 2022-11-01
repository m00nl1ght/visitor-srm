import { createApp } from 'vue'
import { createPinia } from 'pinia'
import './style.css'
import App from './App.vue'
import axios from 'axios'

// axios.defaults.baseURL = 'http://localhost:5173';
// axios.defaults.withCredentials = true; 

const pinia = createPinia()
const app = createApp(App)

app.use(pinia)
app.mount('#app')
