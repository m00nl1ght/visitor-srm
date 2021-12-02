<template>
  <MainModalLayout
    :isOpen="isOpen"
    :onClose="onClose"
    :onConfirm="onConfirm"
    :title="title"
  >
    <v-form class="pt-5" ref="form" v-model="valid" lazy-validation>
      <v-text-field
        v-model="formValue.description"
        outlined
        label="Описание"
        dense
        :rules="rules"
      ></v-text-field>

      <v-textarea
        v-model="formValue.comment"
        outlined
        label="Комменарий"
        dense
        :rules="rules"
      >
      </v-textarea>
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