<template>
  <v-app-bar app clipped-left>
    <v-spacer />

    <div class="d-flex align-center mr-5">
      <v-icon>mdi-theme-light-dark</v-icon>
      <v-switch v-model="$vuetify.theme.dark" inset hide-details class="ml-4"></v-switch>
    </div>

    <v-avatar color="primary">
      <v-icon dark> mdi-account-circle </v-icon>
    </v-avatar>

    <div class="d-flex flex-column ml-5 subtitle-2">
      <span>Вы вошли как:</span>
      <span v-if="activeLoginBtn">{{ currentUser.name }}</span>
      <span v-else>Гость</span>
    </div>

    <v-btn v-if="!activeLoginBtn" color="primary" icon title="Войти" @click="login">
      <v-icon>mdi-login</v-icon>
    </v-btn>
    <v-btn v-else color="primary" icon title="Выйти" @click="logout">
      <v-icon>mdi-logout</v-icon>
    </v-btn>
  </v-app-bar>
</template>

<script>
export default {
  computed: {
    activeLoginBtn() {
      return this.$store.getters['auth/isLoggedIn']
    },
    currentUser() {
      return this.$store.state.user.currentUser
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
