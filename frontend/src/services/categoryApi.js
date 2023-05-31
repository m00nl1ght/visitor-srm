import { BASE_URL } from '@/config.js'
import axios from 'axios'

const urls = {
  GET_VISITOR_CATEGORY: BASE_URL + '/api/visitor/categories',
  GET_SYSTEM_ALARM_CATEGORY: BASE_URL + '/api/systemAlarmList'
}

export default {
  getCategoryList() {
    return axios.get(urls.GET_VISITOR_CATEGORY)
  },

  getSystemAlarmList() {
    return axios.get(urls.GET_SYSTEM_ALARM_CATEGORY)
  }
}
