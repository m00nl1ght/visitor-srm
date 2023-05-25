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
        {text: "Текущая смена", to: { name: 'SecurityCurrentGroup'}},
        {text: "Состав охраны", to: { name: "SecurityList"}},
        {text: "Отчет", to: {name: 'SecurityMainReport'}}
      ]
    }
  },

  mounted() {
    this.$store.dispatch('security/getSecurityRoles')
    this.$store.dispatch('security/getSecurities')
  }
}
</script>