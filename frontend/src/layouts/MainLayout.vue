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

    <v-footer app color="#120a38">
      <v-container>
      <v-row>
        <v-col>
          <div class=" d-flex justify-center">
            <a class="text-decoration-none blue-grey--text" href="https://vk.com/id24405913">&copy; Виталий Ковешников</a>
          </div>
        </v-col>
      </v-row>
      </v-container>
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