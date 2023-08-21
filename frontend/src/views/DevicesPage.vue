<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список IT оборудования сотрудников</v-toolbar-title>
      <v-spacer />
      <v-btn v-if="hasAccessRole(admin)" color="primary" outlined @click="openModal"> Добавить разрешение </v-btn>
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
  data: () => ({
    admin: ['admin']
  }),
  components: {
    DeviceIncomeModal,
    DeviceOpenTable
  },

  computed: {

    hasAccessRole() {
      return this.$store.getters['user/hasAccessRole']
    }

  },

  methods: {
    openModal() {
      this.$store.commit('incomeDevice/openModal')
    }
  }
}
</script>
