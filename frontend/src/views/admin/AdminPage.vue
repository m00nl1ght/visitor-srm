<template>
  <div>
    <v-tabs>
      <v-tab v-for="item in tabs" :key="item.text" :to="item.to">
        {{ item.text }}
      </v-tab>
    </v-tabs>

    <router-view />
  </div>
</template>

<script>
import * as routeNames from '@/router/names/index.js'

export default {
  data() {
    return {
      tabs: [
        { text: 'Пользователи', to: { name: routeNames.adminEditUsersPage } },
        { text: 'Карты доступа', to: { name: routeNames.adminEditCardsPage } }
      ]
    }
  },

  mounted() {
    // this.$store.dispatch('security/getSecurityRoles')
    // this.$store.dispatch('security/getSecurities')
  }
}
</script>
