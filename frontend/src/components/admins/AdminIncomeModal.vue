<template>
  <MainModalLayout :is-open="isOpen" :on-close="onClose" :on-confirm="onConfirm" :title="title">
    <v-form ref="form" v-model="valid" class="pt-5" lazy-validation>
      <v-text-field label="Имя пользователя" :rules="[rules.required]"></v-text-field>
      <v-text-field label="Почта" placeholder="test@test.com" v-model="mail" :rules="[rules.required, rules.email]"></v-text-field>
      <v-autocomplete :items="showRoleList" item-text="title" label="Роль" multiple> </v-autocomplete>

      <v-text-field
        v-model="password"
        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
        :rules="[rules.required]"
        :type="showPassword ? 'text' : 'password'"
        name="input-10-2"
        label="Введите пароль"
        class="input-group--focused"
        @click:append="showPassword = !showPassword"
      ></v-text-field>
      <v-text-field
        v-model="repeatPassword"
        :append-icon="showPasswordRepeat ? 'mdi-eye' : 'mdi-eye-off'"
        :rules="[rules.required, rules.passwordMatch]"
        :type="showPasswordRepeat ? 'text' : 'password'"
        name="input-10-2"
        label="Повторите пароль"
        error
        @click:append="showPasswordRepeat = !showPasswordRepeat"
      ></v-text-field>
    </v-form>
  </MainModalLayout>
</template>

<script>
import MainModalLayout from '@/components/app/modals/MainModalLayout.vue'

export default {
  components: {
    MainModalLayout
  },

  data() {
    return {
      title: 'Форма пользователя',
      password: '',
      repeatPassword: '',
      showPassword: false,
      showPasswordRepeat: false,
      valid: true,
      mail: '',
      rules: {
        required: (value) => !!value || 'Обязятельное поле',
        email: (value) => {
          const pattern =
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || 'Неверный e-mail.'
        },
        passwordMatch: () => this.repeatPassword === this.password || `Пароли не совпадают`
      }
    }
  },

  computed: {
    isOpen() {
      return this.$store.state.user.openModal
    },
    showRoleList() {
      return this.$store.state.user.rolesList
    }
  },
  mounted() {
    this.$store.dispatch('user/getRolesList')
  },
  methods: {
    onClose() {
      this.$store.commit('user/closeModal')
    },
    onConfirm() {
      // if (this.$refs.form.validate()) {}
    }
  }
}
</script>
