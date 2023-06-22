<template>
  <MainModalLayout :is-open="isOpen" :on-close="onClose" :on-confirm="onConfirm">
    <v-form ref="form" v-model="valid" class="pt-5" lazy-validation>
      <v-text-field outlined label="Сетевое имя" dense />

      <v-text-field outlined label="Фамилия" dense />

      <v-text-field outlined label="Имя" dense />

      <v-text-field outlined label="Отчество" dense :rules="rules" />
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
      valid: true,
      rules: [(v) => !!v || 'Поле обязательно для заполнения']
    }
  },

  computed: {
    isOpen() {
      return this.$store.state.incomeDevice.openModal
    },

    formValue() {
      return this.$store.state.incomeDevice.formValue
    }

    // title() {
    //     return this.$store.state.incomeDevice.formValue.id ? 'Редактировать запись' : 'Создать запись'
    // }
  },

  methods: {
    onClose() {
      this.$store.commit('incomeDevice/closeModal')
    },

    onConfirm() {
      if (this.$refs.form.validate()) {
        this.$store.dispatch('incomeDevice/registrateDevice')
      }
    }
  }
}
</script>
