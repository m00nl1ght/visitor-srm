<template>
  <v-app>
    <Snackbar />
    
    <Navbar />

    <Appbar />
    
    <v-main>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-main>

    <AppFooter />
  </v-app>
</template>

<script>
import Navbar from '@/components/app/Navbar'
import Snackbar from '@/components/app/Snackbar'
import Appbar from '@/components/app/Appbar'
import AppFooter from '@/components/app/AppFooter.vue';

export default {
  components: {
    Navbar,
    Snackbar,
    Appbar,
    AppFooter
  },

  mounted() {
    this.$store.dispatch('securityGroup/getCurrentGroup')
  }
};
</script>