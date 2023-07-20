<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список IT оборудования сотрудников</v-toolbar-title>
      <v-spacer />
      <v-btn color="primary" outlined @click="openModal"> Добавить разрешение </v-btn>
    </v-toolbar>

    <DeviceIncomeModal />

    <v-card-text>
      <DeviceOpenTable />
    </v-card-text>
  </v-card>
</template>

<script>
import DeviceIncomeModal from '@/components/devices/DeviceIncomeModal.vue'
import DeviceOpenTable from '@/components/devices/DeviceOpenTable.vue'

export default {
  components: {
    DeviceIncomeModal,
    DeviceOpenTable
  },

  computed: {},

  methods: {
    openModal() {
      this.$store.commit('incomeDevice/openModal')
    }
  }
}
</script>
