<template>
  <v-dialog v-model="modal" persistent max-width="600px">
    <v-card>
      <v-card-title>
        <span class="text-h5">{{ title }}</span>

        <v-spacer />

        <v-btn icon large @click="onClose">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-title>

      <v-divider />

      <v-card-text>
        <slot />
      </v-card-text>

      <v-card-actions>
        <v-spacer />
        <v-btn text @click="onClose">
          {{ closeBtnTitle }}
        </v-btn>
        <v-btn color="primary" text @click="onConfirm" :loading="isLoading">
          {{ confirmBtnTitle }}
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
      default: ''
    },
    closeBtnTitle: {
      type: String,
      default: 'Отмена'
    },
    confirmBtnTitle: {
      type: String,
      default: 'Сохранить'
    },
    isLoading: {
      type: Boolean,
      default: false
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
