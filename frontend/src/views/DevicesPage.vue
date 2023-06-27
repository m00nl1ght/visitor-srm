<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список IT оборудования сотрудников</v-toolbar-title>
      <v-spacer />
      <v-btn @click="openModal" outlined x-large color="success">Новое разрешение</v-btn>
      <v-btn x-large color="primary">Все разрешения</v-btn>
    </v-toolbar>
    <DeviceIncomeModal />
    <v-card-text>
      <DeviceOpenTable :items="openDeviceList"/>
    </v-card-text>
  </v-card>
</template>

<script>
import DeviceIncomeModal from '@/components/devices/DeviceIncomeModal.vue'
import DeviceOpenTable from '@/components/devices/DeviceOpenTable.vue';

export default {
  components: {
    DeviceIncomeModal,
    DeviceOpenTable
  },

  computed: {
    openDeviceList() {
      return this.$store.state.incomeDevice.openDeviceList
    }
  },

  mounted() {
    this.$store.dispatch('incomeDevice/getDeviceList')
  },

  methods: {
    openModal() {
      this.$store.commit('incomeDevice/openModal')
    }
  }
}
</script>
