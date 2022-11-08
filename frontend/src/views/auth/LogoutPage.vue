<template>
  <h1>Logout</h1>
</template>

<script>
export default {
  async beforeMount() {
    await this.$store.dispatch('auth/logout')
    await this.$store.commit('user/storeCurrentUser', undefined)
    this.$router.push('/login')
  }
}
</script>
