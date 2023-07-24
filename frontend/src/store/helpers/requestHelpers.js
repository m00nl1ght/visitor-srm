import store from '@/store/index.js'

/*
example usage:

1) chain decorators. 'this' context inside decorators is undefined usually.
withLoadingIndicator(
  withNotifier(
    dispatch("async action", { ...payload }))
);

2) chain async anon fns. 'this' context inside decorators is undefined usually.
withLoadingIndicator(async () => {
  await withNotifier(async () => {
    await dispatch("async action", { ...payload });
  });
});

*/

function createWithLoadingIndicator({ commit }) {
  return async function (func, loaderObj = undefined) {
    const isPromise = func && func.constructor.name === 'Promise'

    if (!isPromise && typeof func !== 'function') throw new Error("parameter 'func' must be a function or promise")
    if (loaderObj) {
      commit('appProgressBanner/setLoadingObject', { loaderObj, data: true })
    } else commit('appProgressBanner/setLoading', true)

    try {
      if (isPromise) {
        await func
      } else {
        await func.apply(this, [...arguments].shift())
      }
    } catch {
      // eat
    }

    if (loaderObj) {
      commit('appProgressBanner/setLoadingObject', { loaderObj, data: false })
    } else commit('appProgressBanner/setLoading', false)
  }
}

function createWithNotifier({ dispatch }) {
  return async function (func, text) {
    const isPromise = func && func.constructor.name === 'Promise'
    if (!isPromise && typeof func !== 'function') throw new Error("parameter 'func' must be a function or promise")

    try {
      if (isPromise) {
        await func
      } else {
        await func.apply(this, [...arguments].slice(2))
      }
      if (text) {
        dispatch('appNotifications/notifySuccess', { code: 'success', text })
      }
    } catch (err) {
      dispatch('appNotifications/notifyError', err)
    }
  }
}

export const withLoadingIndicator = createWithLoadingIndicator(store)
export const withNotifier = createWithNotifier(store)
