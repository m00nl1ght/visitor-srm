import axios from 'axios'

const urls = {
  EVENT: '/api/income-event'
}

export default {
  getOpenEventList() {
    return axios.get(urls.EVENT)
  },

  addEvent(payload) {
    return axios.post(urls.EVENT, payload)
  },

  editEvent(payload) {
    return axios.put(urls.EVENT + '/' + payload.id, payload)
  },

  deleteEvent(id) {
    return axios.delete(urls.EVENT + '/' + id)
  }
}
