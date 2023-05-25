<template>
  <v-app>
    <SnackBar />
    
    <NavBar />

    <AppBar />
    
    <v-main>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-main>

    <AppFooter />
  </v-app>
</template>

<script>
import NavBar from '@/components/app/NavBar'
import SnackBar from '@/components/app/SnackBar'
import AppBar from '@/components/app/AppBar'
import AppFooter from '@/components/app/AppFooter.vue';

export default {
  components: {
    NavBar,
    SnackBar,
    AppBar,
    AppFooter
  },

  mounted() {
    this.$store.dispatch('securityGroup/getCurrentGroup')
  }
};
</script>