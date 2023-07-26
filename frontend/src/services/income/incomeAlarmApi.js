import axios from 'axios'

const urls = {
  ALARM: '/api/income-alarm'
}

export default {
  getOpenAlarmList() {
    return axios.get(urls.ALARM)
  },

  addAlarm(payload) {
    return axios.post(urls.ALARM, payload)
  },

  editAlarm(payload) {
    return axios.put(urls.ALARM + '/' + payload.id, payload)
  },

  deleteAlarm(id) {
    return axios.delete(urls.ALARM + '/' + id)
  },

  closeAlarm(id) {
    return axios.post(urls.ALARM + '/close', { id: id })
  }
}
