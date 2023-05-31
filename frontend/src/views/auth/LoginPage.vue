<template>
  <v-container
    fluid
    class="container-box"
  >
    <v-row
      no-gutters
      class="d-flex align-center h-100"
    >
      <v-card
        class="text-center w-100 pa-1"
        elevation="0"
        max-width="600px"
      >
        <v-card-title class="justify-center mb-2">
          Введите учетные данные
        </v-card-title>

        <v-card-text>
          <v-alert
            v-if="error"
            border="left"
            colored-border
            type="error"
            outlined
            dense
          >
            Неверный логин или пароль
          </v-alert>

          <v-form
            ref="form"
            v-model="valid"
            lazy-validation
          >
            <v-text-field
              v-model="email"
              :rules="emailRules"
              label="Login"
              required
              clearable
              @input="resetError"
            />

            <v-text-field
              v-model="password"
              :rules="passwordRules"
              label="Password"
              required
              clearable
              @input="resetError"
            />

            <v-btn
              :disabled="!valid"
              color="primary"
              outlined
              class="mt-5"
              @click="validate"
            >
              Войти
            </v-btn>
          </v-form>
        </v-card-text>
      </v-card>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    valid: true,
    error: false,

    email: '',
    emailRules: [v => !!v || 'Поле обязательно для заполнения'],
    // emailRules: [v => !!v || 'Поле обязательно для заполнения', v => /.+@.+\..+/.test(v) || 'Некорректный e-mail'],
    password: undefined,
    passwordRules: [v => !!v || 'Поле обязательно для заполнения']
  }),

  methods: {
    async validate() {
      if (this.$refs.form.validate()) {
        const resp = await this.$store.dispatch('auth/login', {
          email: this.email,
          password: this.password
        })
        if (resp.success) {
          await this.$store.dispatch('user/getCurrentUser')
          this.$router.push('/')
        }
        else this.error = true
      }
    },

     resetError() {
      this.error = false
     }
  }
}
</script>

<style lang="scss" scoped>
.w-100 {
  width: 100%;
}

.h-100 {
  height: 100%;
  align-items: center;
  justify-content: center;
}

.container-box {
  height: 100vh;
  background: linear-gradient(#3f51b5, #b0bec5);
}
</style>
