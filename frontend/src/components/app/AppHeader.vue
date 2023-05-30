<template>
  <v-app-bar
    app
    clipped-left
  >
    <v-spacer />

    <v-avatar color="primary">
      <v-icon dark>
        mdi-account-circle
      </v-icon>
    </v-avatar>

    <div class="d-flex flex-column ml-5 subtitle-2">
      <span>Вы вошли как:</span>
      <span v-if="activeLoginBtn">Сотрудник охраны</span>
    </div>

    <v-btn
      v-if="!activeLoginBtn"
      color="primary"
      icon
      title="Войти"
      @click="login"
    >
      <v-icon>mdi-login</v-icon>
    </v-btn>
    <v-btn
      v-else
      color="primary"
      icon
      title="Выйти"
      @click="logout"
    >
      <v-icon>mdi-logout</v-icon>
    </v-btn>
  </v-app-bar>
</template>

<script>
export default {
  computed: {
    activeLoginBtn() {
      return this.$store.getters['auth/isLoggedIn']
    }
  },

  methods: {
    login() {
      this.$router.push('/login')
    },
    async logout() {
      this.$router.push('/logout')
    }
  }
}
</script>
