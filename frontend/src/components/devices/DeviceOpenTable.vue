<template>
  <v-card-text>
    <v-container>
      <v-row>
        <v-col cols="1" md="4">
          <v-text-field label="Введите сетевое имя устройства"> </v-text-field>
        </v-col>
      </v-row>
    </v-container>
    <v-btn @click="getListDeviceStatus(statuses)">TEST</v-btn>
    <v-btn @click="getNetworkNameDataList(showListDeviceStatus)">TEST</v-btn>
    <v-data-table>
      <template #no-data>
        <p>Разрешения отсутсвуют...</p>
      </template>
    </v-data-table>
  </v-card-text>
</template>

<script>
export default {
  data: () => ({
    statuses: ['new'],
    listStatus: ['new', 'approved', 'no_data']
  }),

  computed: {
    showListDeviceStatus() {
      return this.$store.state.incomeDevice.listDeviceStatus
    },

    showFullListDevice() {
      return this.$store.state.incomeDevice.fullListdevice
    }
  },

  methods: {
    getListDeviceStatus(statuses) {
      // console.log('statuses', statuses)
      this.$store.dispatch('incomeDevice/getListDeviceStatus', statuses)
    },

    getNetworkNameDataList(list) {
      // console.log('showList', list)
      this.$store.dispatch('incomeDevice/getNetworkNameDataList', list)
    }
  }
}
</script>
