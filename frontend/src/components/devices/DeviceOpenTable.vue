<template>
  <v-card-text>
    <v-container>
      <v-row>
        <v-col md="3">
          <v-text-field label="Введите имя устройства или фамилию"> </v-text-field>
        </v-col>
      </v-row>
    </v-container>

    <v-col class="d-flex" cols="12" md="3">
      <v-select :items="listStatus" v-model="statuses" @change="getDeviceList" multiple label="Статус"></v-select>
    </v-col>

    <v-btn @click="setTrue()">TRUE</v-btn>
    <v-btn @click="setFalse()">FALSE</v-btn>

    <v-data-table :headers="headers" :items="showListDeviceStatus">
      <template #[`item.access`]="{ item }">
        <v-chip class="ma-2" :color="item.status === 'approved' ? 'green' : 'red'" text-color="black" outlined>
          {{ item.status === 'approved' ? 'Разрешено' : 'Не разрешено' }}
        </v-chip>
      </template>

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
    listStatus: [STATUSES.NEW, STATUSES.APPROVED, STATUSES.REJECTED],
    edit: true
  }),

  computed: {
    showListDeviceStatus() {
      return this.$store.state.incomeDevice.listDeviceStatus
    },

    headers() {
      let head = [
        { text: 'Разрешение', value: 'access', sortable: false },
        { text: 'ФИО', value: 'employee.lastName', sortable: false },
        { text: 'Модель', value: 'details.name', sortable: false },
        { text: 'Сетевое имя', value: 'details.networkName', sortable: false },
        { text: 'Инвентарный номер', value: 'details.inventoryNumber', sortable: false },
        { text: 'Серийный номер', value: 'details.serialNumber', sortable: false }
      ]

      if (this.edit === true) {
        head.push({ text: 'Статус', value: 'status', sortable: false })
        head.push({ text: 'Действия', value: 'actions', sortable: false })
        head.push({ text: 'Подтверждение', value: 'approves', sortable: false })
      }

      return head
    },

    statuses: {
      get() {
        return this.$store.state.incomeDevice.statuses
      },
      set(newValue) {
        this.$store.commit('incomeDevice/changeStatuses', newValue)
        console.log(newValue)
      }
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
      this.$store.commit('incomeDevice/openEditModal', item.id)
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
