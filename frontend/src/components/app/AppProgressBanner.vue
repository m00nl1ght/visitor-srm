<template>
  <v-overlay :value="showBanner" z-index="2000">
    <v-progress-circular indeterminate size="64" color="primary"></v-progress-circular>
  </v-overlay>
</template>

<script>
import { mapState } from 'vuex'
export default {
  props: {
    // showBanner: {
    //   type: Boolean,
    //   default: () => false
    // }
  },

  computed: {
    ...mapState('appProgressBanner', {
      showBanner: 'showBanner'
    })
  }
}
</script>
