<template>
    <v-card>
      <v-toolbar>
        <v-toolbar-title>Список активных неисправностей</v-toolbar-title>
        <v-spacer />
        <v-btn 
          @click="openModal"
          color="primary"
          outlined
        >Добавить неисправность</v-btn>
      </v-toolbar>

      <v-card-text>
        <AlarmOpenTable :items="openAlarmList"/>
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

  computed: {
    openAlarmList() {
      return this.$store.state.incomeAlarm.openAlarmList
    }
  },

  methods: {
    openModal() {
      this.$store.commit('incomeAlarm/openAddModal')
    }
  },

  mounted() {
    this.$store.dispatch('incomeAlarm/getOpenAlarmList')
  }
}
</script>