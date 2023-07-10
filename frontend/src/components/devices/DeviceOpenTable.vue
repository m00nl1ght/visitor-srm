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
      <v-select :items="listStatus" v-model="statuses" multiple @change="getDeviceList" label="Статус"></v-select>
    </v-col>

    <v-btn @click="setTrue()">TRUE</v-btn>
    <v-btn @click="setFalse()">FALSE</v-btn>

    <v-data-table :headers="headers" :items="showListDeviceStatus">
      <template #[`item.employee.lastName`]="{ item }">
        <span>{{ item.employee.lastName }} {{ item.employee.name }} {{ item.employee.middleName }}</span>
      </template>

      <template #[`item.actions`]="{ item }">
        <v-btn icon @click="onEdit(item)">
          <v-icon>mdi-pencil-outline</v-icon>
        </v-btn>

        <v-btn icon @click="onDelete(item.id)">
          <v-icon>mdi-trash-can-outline</v-icon>
        </v-btn>
      </template>

      <template #[`item.approves`]="{ item }">
        <v-btn icon color="green" @click="onApproved(item.id)">
          <v-icon>mdi-thumb-up</v-icon>
        </v-btn>

        <v-btn icon color="red" @click="onRejected(item.id)">
          <v-icon>mdi-thumb-down</v-icon>
        </v-btn>
      </template>

      <template #no-data>
        <p>Разрешения отсутсвуют...</p>
      </template>
    </v-data-table>
  </v-card-text>
</template>

<script>
const STATUSES = {
  NEW: 'new',
  APPROVED: 'approved',
  REJECTED: 'rejected'
}

export default {
  data: () => ({
    statuses: [STATUSES.NEW],
    listStatus: [STATUSES.NEW, STATUSES.APPROVED],
    edit: true
  }),

  computed: {
    showListDeviceStatus() {
      return this.$store.state.incomeDevice.listDeviceStatus
    },

    headers() {
      let head = [
        { text: 'ФИО', value: 'employee.lastName', sortable: false },
        { text: 'Модель', value: 'details.name', sortable: false },
        { text: 'Сетевое имя', value: 'details.networkName', sortable: false },
        { text: 'Инвентарный номер', value: 'details.inventoryNumber', sortable: false },
        { text: 'Серийный номер', value: 'details.serialNumber', sortable: false },
        { text: 'Статус', value: 'status', sortable: false }
      ]

      if (this.edit === true) {
        head.push({ text: 'Действия', value: 'actions', sortable: false })
        head.push({ text: 'Подтверждение', value: 'approves', sortable: false })
      }

      return head
    }
  },

  mounted() {
    this.getDeviceList()
    // this.$store.dispatch('incomeDevice/getListDeviceStatus', this.statuses)
  },

  methods: {
    getDeviceList() {
      this.$store.dispatch('incomeDevice/getListDeviceStatus', this.statuses)
    },

    setTrue() {
      this.edit = true
      console.log(this.edit)
    },
    setFalse() {
      this.edit = false
      console.log(this.edit)
    },

    onEdit(item) {
      console.log(item)
    },

    onDelete(id) {
      console.log(id)
    },

    onApproved(id) {
      this.$store.dispatch('incomeDevice/changeStatus', { id: id, status: STATUSES.APPROVED, callback: this.getDeviceList })
    },

    onRejected(id) {
      this.$store.dispatch('incomeDevice/changeStatus', { id: id, status: STATUSES.REJECTED, callback: this.getDeviceList })
    }
  }
}
</script>
