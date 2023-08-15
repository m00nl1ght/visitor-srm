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
        { text: 'Текущая смена', to: { name: routeNames.securityCurrentGroup } },
        { text: 'Состав охраны', to: { name: routeNames.securityList } },
        // { text: 'Отчет за смену', to: { name: routeNames.securityMainReport } }
      ]
    }
  },

  mounted() {
    this.$store.dispatch('security/getSecurityRoles')
    this.$store.dispatch('security/getSecurities')
  }
}
</script>
