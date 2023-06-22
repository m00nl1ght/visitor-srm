<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список IT оборудования сотрудников</v-toolbar-title>
      <v-spacer />
      <v-btn @click="openModal" outlined x-large color="success">Новое разрешение</v-btn>
      <v-btn x-large color="primary">Все разрешения</v-btn>
    </v-toolbar>
    <DeviceIncomeModal />
  </v-card>
</template>

<script>
import DeviceIncomeModal from '@/components/devices/DeviceIncomeModal.vue'

export default {
  components: {
    DeviceIncomeModal
  },

  methods: {
    openModal() {
      this.$store.commit('incomeDevice/openAddModal')
    }
  }
}
</script>
