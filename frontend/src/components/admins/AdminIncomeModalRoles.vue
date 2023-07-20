<template>
  <MainModalLayout :is-open="isOpen" :on-close="onClose" :on-confirm="onConfirm" :title="title">
    <v-form ref="form" v-model="valid" class="pt-5" lazy-validation>
    <v-text-field></v-text-field> </v-form>
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
      title: 'Добавить роль',
      valid: true
    }
  },

  computed: {
    isOpen() {
        return this.$store.state.openModalRoles
    }
  },

  methods: {
    onClose() {},
    onConfirm() {}
  }
}
</script>
