<template>
  <MainModalLayout
    :is-open="isOpen"
    :on-close="onClose"
    :on-confirm="onConfirm"
    :title="title"
  >
    <v-form
      ref="form"
      v-model="valid"
      class="pt-5"
      lazy-validation
    >
      <v-text-field
        v-model="formValue.description"
        outlined
        label="Описание"
        dense
        :rules="rules"
      />

      <v-textarea
        v-model="formValue.comment"
        outlined
        label="Комменарий"
        dense
        :rules="rules"
      />
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
      rules: [
        v => !!v || 'Поле обязательно для заполнения',
      ],
    }
  },

  computed: {
    isOpen() { 
      return this.$store.state.incomeEvent.openModal
    },

    formValue() { 
      return this.$store.state.incomeEvent.formValue 
    },

    title() {
      return this.$store.state.incomeEvent.formValue.id ? 'Редактировать запись' : 'Создать запись'
    }
  },

  methods: {
    onClose() {
      this.$store.commit('incomeEvent/closeModal')
    },

    onConfirm() {
      if(this.$refs.form.validate()) {
        this.$store.dispatch('incomeEvent/registrateEvent')
      }
    },
  }
}
</script>