<template>
  <v-dialog
    v-model="modal"
    persistent
    max-width="500px"
  >
    <v-card>
      <v-card-title class="text-h5">
        {{ title }}
      </v-card-title>

      <v-divider />

      <v-card-text class="pt-5">
        <slot />
      </v-card-text>

      <v-divider />

      <v-card-actions>
        <v-btn
          text
          @click="onClose"
        >
          Отмена
        </v-btn>

        <v-spacer />

        <v-btn
          color="primary"
          text
          @click="onConfirm"
        >
          Подтвердить
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    isOpen: Boolean,
    onClose: Function,
    onConfirm: Function,
    title: {
      type: String,
      default: 'Подтвердите совершаемое действие'
    }
  },

  computed: {
    modal: {
      get() {
        return this.isOpen
      },
      set(value) {
        this.$emit('input', value)
      }
    }
  }
}
</script>
