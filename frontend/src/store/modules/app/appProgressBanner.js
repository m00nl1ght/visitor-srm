import Vue from 'vue'

const state = {
  showBanner: false,
  loadingObj: {},
  loadingObjCount: {}
}

const getters = {
  loaderObj(state) {
    return (loaderName) => {
      if (Array.isArray(loaderName)) {
        return (
          Object.keys(state.loadingObj).filter((key) => {
            return loaderName.includes(key) && state.loadingObj[key] === true
          }).length > 0
        )
      }
      return state.loadingObj[loaderName] || false
    }
  }
}

const mutations = {
  SHOW_PROGRESS_BANNER_MUT(state) {
    state.showBanner = true
  },

  CLOSE_PROGRESS_BANNER_MUT(state) {
    state.showBanner = false
  },

  setLoadingObject(state, params) {
    const { loaderObj, data } = params
    // console.log(loaderObj, data);
    if (loaderObj && loaderObj.length) {
      loaderObj.forEach((key) => {
        if (state.loadingObjCount[key] === undefined) Vue.set(state.loadingObjCount, key, 0)
        data
          ? Vue.set(state.loadingObjCount, key, state.loadingObjCount[key] + 1)
          : Vue.set(state.loadingObjCount, key, state.loadingObjCount[key] - 1)
        if (state.loadingObjCount[key] < 0) Vue.set(state.loadingObjCount, key, 0)

        if ((!data && state.loadingObjCount[key] === 0) || data) Vue.set(state.loadingObj, key, data)
      })
    }
  },

  setLoading(state, payload) {
    state.showBanner = payload
  }
}

const actions = {}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
