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
        { text: 'Сводный', to: { name: routeNames.reportOverviewPage } },
        { text: 'Аналитика', to: { name: routeNames.reportAnaliticsPage } }
      ]
    }
  }
}
</script>
