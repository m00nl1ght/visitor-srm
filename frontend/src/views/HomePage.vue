<template>
  <h1>{{ activeLoginBtn ? 'Главная страница' : 'Для работы войдите в систему' }}</h1>
</template>

<script>
export default {
  computed: {
    activeLoginBtn() {
      return this.$store.getters['auth/isLoggedIn']
    }
  }
}
</script>
