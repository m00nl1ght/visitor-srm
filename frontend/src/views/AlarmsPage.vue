<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список активных неисправностей</v-toolbar-title>
      <v-spacer />
      <v-btn v-if="hasAccessRole(securityGroup)" color="primary" outlined @click="openModal"> Добавить неисправность </v-btn>
    </v-toolbar>

    <v-card-text>
      <AlarmOpenTable v-if="(openAlarmList && openAlarmList.length > 0) || isLoading" :items="openAlarmList" :isLoading="isLoading" />
      <p v-else>Территория пуста, все посетители дома...</p>
    </v-card-text>

    <AlarmIncomeModal />
  </v-card>
</template>

<script>
import AlarmOpenTable from '@/components/alarms/AlarmOpenTable.vue'
import AlarmIncomeModal from '@/components/alarms/AlarmIncomeModal.vue'

export default {
  components: {
    AlarmOpenTable,
    AlarmIncomeModal
  },

  data: () => ({
    securityGroup: ['admin', 'security', 'security_chief', 'employee_security_chief']
  }),

  computed: {
    openAlarmList() {
      return this.$store.state.incomeAlarm.openAlarmList
    },

    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj']('getOpenAlarmList')
    },

    hasAccessRole() {
      return this.$store.getters['user/hasAccessRole']
    }
  },

  methods: {
    openModal() {
      this.$store.commit('incomeAlarm/openAddModal')
    }
  },

  async mounted() {
    if (this.openAlarmList && this.openAlarmList.length == 0) {
      await this.$withLoadingIndicator(async () => await this.$store.dispatch('incomeAlarm/getOpenAlarmList'), ['getOpenAlarmList'])
    }
  }
}
</script>
