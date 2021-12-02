<template>
  <v-app>
    <Snackbar />
    
    <Navbar />

    <v-app-bar app clipped-left></v-app-bar>
    
    <v-main>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-main>

    <v-footer app>
      <p>footer</p>
    </v-footer>
  </v-app>
</template>

<script>
import Navbar from '@/components/app/Navbar'
import Snackbar from '@/components/app/Snackbar'

export default {
  components: {
    Navbar,
    Snackbar
  },

  mounted() {
    this.$store.dispatch('securityGroup/getCurrentGroup')
  }
};
</script>