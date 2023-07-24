<template>
  <v-snackbar v-model="snackbar" top :timeout="duration" style="z-index: 1200 !important" :color="getColor">
    <div class="d-flex flex-column">
      <span v-for="(msg, idx) in errorMessagesArray" :key="idx" class="text-box">{{ msg }}</span>
    </div>
    <template #action="{ attrs }">
      <v-btn color="primary" icon v-bind="attrs" @click="close">
        <v-icon color="white">mdi-close</v-icon>
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script>
import { mapState } from 'vuex'

export default {
  props: {
    // showMessage: Boolean,
    // messagesArray: Array,
    // code: [String, Number],
    // duration: {
    //   type: [String, Number],
    //   default: 3000
    // }
  },

  computed: {
    ...mapState('appNotifications', {
      showMessage: 'showMessage',
      messagesArray: 'messagesArray',
      code: 'code',
      duration: (state) => state.duration ?? 3000
    }),

    snackbar: {
      get() {
        return this.showMessage
      },
      set(value) {
        if (!value) this.$store.commit('appNotifications/clearNotificationMessage')
      }
    },

    errorMessagesArray() {
      return this.messagesArray.map((errorText) => {
        if (this.$t(errorText)) return this.$t(errorText)
        return errorText
      })
    },

    getColor() {
      if (this.code >= 500) return 'error'
      else if (this.code >= 400) return 'warning'
      else if (this.code >= 200) return 'success'
      else return 'info'
    }
  },

  methods: {
    close() {
      this.snackbar = false
    }
  },

  watch: {
    showMessage() {
      this.snackbar = this.showMessage
    }
  }
}
</script>

<style lang="scss" scoped>
.text-box {
  word-break: break-word;
}
</style>
