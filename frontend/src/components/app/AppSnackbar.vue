<template>
  <v-snackbar
    v-model="snackbar"
    multi-line
  >
    {{ snackbarStore.message }}

    <template #action="{ attrs }">
      <v-btn
        color="red"
        text
        v-bind="attrs"
        @click="onClose"
      >
        Close
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script>
export default {
  computed: {
    snackbarStore() {
      return this.$store.getters['globalSnackbar/mainSnackbar']
    },

    snackbar: {
      get() {
        return this.snackbarStore.isOpen
      },
      set(val) {
        console.log(val)
      }
    }
  },

  methods: {
    onClose() {
      console.log('close')
    }
  }
}
</script>