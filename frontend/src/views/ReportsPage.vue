<template>
  <div>
    <v-tabs>
      <v-tab
        v-for="item in tabs"
        :key="item.text"
        :to="item.to"
      >
        {{ item.text }}
      </v-tab>
    </v-tabs>

    <router-view />
  </div>
</template>

<script>
export default {
  data() {
    return {
      tabs: [
        {text: "Сводный", to: { name: 'ReportOverview'}},
        {text: "Аналитика", to: { name: "ReportAnalitics"}}
      ]
    }
  }
}
</script>