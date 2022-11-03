<template>
  <v-app-bar app clipped-left>
    <v-spacer />

    <v-avatar color="primary">
      <v-icon dark>
        mdi-account-circle
      </v-icon>
    </v-avatar>

    <div class="d-flex flex-column ml-5 subtitle-2">
      <span>Вы вошли как:</span>
      <span>Сотрудник охраны</span>
    </div>

    <v-btn @click="login" color="primary" icon title="Войти"><v-icon>mdi-login</v-icon></v-btn>
    <v-btn @click="logout" color="primary" icon title="Выйти"><v-icon>mdi-logout</v-icon></v-btn>
  </v-app-bar>
</template>

<script>
export default {
  methods: {
    login() {
      this.$router.push('/login')
    },
    logout() {
      this.$router.push('/logout')
    }
  }
}
</script>
