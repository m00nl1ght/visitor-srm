<template>
  <v-app>
    <AppProgressBanner />

    <AppNavbar />

    <AppHeader />

    <v-main>
      <AppNotificationBanner />
      
      <v-container fluid>
        <router-view />
      </v-container>
    </v-main>

    <AppFooter />
  </v-app>
</template>

<script>
import AppProgressBanner from '@/components/app/AppProgressBanner.vue'
import AppNotificationBanner from '@/components/app/AppNotificationBanner.vue'

import AppNavbar from '@/components/app/AppNavbar.vue'
import AppHeader from '@/components/app/AppHeader.vue'
import AppFooter from '@/components/app/AppFooter.vue'

export default {
  components: {
    AppProgressBanner,
    AppNotificationBanner,
    AppNavbar,
    AppHeader,
    AppFooter
  },

  mounted() {
    this.$store.dispatch('securityGroup/getCurrentGroup')
  }
}
</script>
