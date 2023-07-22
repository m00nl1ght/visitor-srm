import axios from 'axios'

const urls = {
  GET_VISITOR_CATEGORY: '/api/visitor/categories',
  GET_SYSTEM_ALARM_CATEGORY: '/api/systemAlarmList'
}

export default {
  getCategoryList() {
    return axios.get(urls.GET_VISITOR_CATEGORY)
  },

  getSystemAlarmList() {
    return axios.get(urls.GET_SYSTEM_ALARM_CATEGORY)
  }
}
