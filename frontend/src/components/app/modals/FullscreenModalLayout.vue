<template>
  <v-row justify="center">
    <v-dialog v-model="modal" fullscreen hide-overlay transition="dialog-bottom-transition">
      <v-card>
        <v-toolbar dark color="primary">
          <v-btn icon dark @click="onClose">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title>{{ title }}</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark text @click="onConfirm">
              {{ confirmBtnTitle }}
            </v-btn>
          </v-toolbar-items>
        </v-toolbar>

        <slot></slot>
      </v-card>
    </v-dialog>
  </v-row>
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
    confirmBtnTitle: {
      type: String,
      default: 'Сохранить'
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
  },

  methods: {
    printCard() {},

    closeDialog() {}
  }
}
</script>
