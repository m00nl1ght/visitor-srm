<template>
  <v-card-text>
    <v-container>
      <v-row>
        <v-col cols="1" md="4">
          <v-text-field label="Введите сетевое имя устройства"> </v-text-field>
        </v-col>
      </v-row>
    </v-container>
    <v-col class="d-flex" cols="12" sm="6">
      <v-select :items="listStatus" v-model="statuses" multiple @change="getListDeviceStatus(statuses)" label="Standard"></v-select>
    </v-col>
    <!-- <v-btn @click="getListDeviceStatus(statuses)">TEST</v-btn>
    <v-btn @click="getNetworkNameDataList(showListDeviceStatus)">TEST</v-btn> -->
    <v-data-table :headers="headers" :items="showListDeviceStatus">
      <template #[`item.employee.lastName`]="{ item }">
        <span>{{ item.employee.lastName }} {{ item.employee.name }} {{ item.employee.middleName }}</span>
      </template>
      <template #no-data>
        <p>Разрешения отсутсвуют...</p>
      </template>
    </v-data-table>
  </v-card-text>
</template>

<script>
export default {
  data: () => ({
    statuses: [],
    listStatus: ['new', 'approved', 'no_data'],

    headers: [
      { text: 'ФИО', value: 'employee.lastName' }, //тут надо вывести ФИО, сейчас только фамилия
      { text: 'Модель', value: 'details.name' },
      { text: 'Сетевое имя', value: 'details.networkName' },
      { text: 'Инвентарный номер', value: 'details.inventoryNumber' },
      { text: 'Серийный номер', value: 'details.serialNumber' },
      { text: 'Статус', value: 'status' }
    ]
  }),
  watch: {},

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
