<template>
  <MainModalLayout :is-open="isOpen" :on-close="onClose" :on-confirm="onConfirm" :title="title">
    <v-form ref="form" v-model="valid" class="pt-5" lazy-validation>
      <v-text-field label="Имя пользователя" :rules="[rules.required]" v-model="userForm.name"></v-text-field>
      <v-text-field label="Почта" placeholder="test@test.com" v-model="userForm.email" :rules="[rules.required, rules.email]"></v-text-field>

      <v-text-field
        v-model="userForm.password"
        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
        :rules="[rules.required]"
        :type="showPassword ? 'text' : 'password'"
        label="Введите пароль"
        @click:append="showPassword = !showPassword"
      ></v-text-field>
      <v-text-field
        v-model="repeatPassword"
        :append-icon="showPasswordRepeat ? 'mdi-eye' : 'mdi-eye-off'"
        :rules="[rules.required, rules.passwordMatch]"
        :type="showPasswordRepeat ? 'text' : 'password'"
        label="Повторите пароль"
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
      userForm: {
        name: '',
        email: '',
        password: ''
      },
      title: 'Форма пользователя',
      repeatPassword: '',
      showPassword: false,
      showPasswordRepeat: false,
      valid: true,

      rules: {
        required: (value) => !!value || 'Обязятельное поле',
        email: (value) => {
          const pattern =
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || 'Неверный e-mail.'
        },
        passwordMatch: () => this.repeatPassword === this.userForm.password || `Пароли не совпадают`
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
      if (this.$refs.form.validate()) {
        // this.$store.dispatch('user/registration', this.userForm)
        this.$store.commit('user/closeModal')
      }
      this.userForm.name = '',
      this.userForm.email = '',
      this.userForm.password = '',
      this.repeatPassword = ''      
    }
  }
}
</script>
