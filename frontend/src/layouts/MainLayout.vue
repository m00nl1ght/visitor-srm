<template>
  <v-app>
    <AppSnackbar />

    <AppNavbar />

    <AppHeader />

    <v-main>
      <v-container fluid>
        <router-view />
      </v-container>
    </v-main>

    <AppFooter />
  </v-app>
</template>

<script>
import AppNavbar from '@/components/app/AppNavbar.vue'
import AppSnackbar from '@/components/app/AppSnackbar.vue'
import AppHeader from '@/components/app/AppHeader.vue'
import AppFooter from '@/components/app/AppFooter.vue'

export default {
  components: {
    AppNavbar,
    AppSnackbar,
    AppHeader,
    AppFooter
  },

  mounted() {
    this.$store.dispatch('securityGroup/getCurrentGroup')
  }
}
</script>
