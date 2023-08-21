<template>
  <v-card-text>
    <v-col class="d-flex" cols="12" md="3">
      <v-select v-if="edit" :items="listStatus" v-model="statuses" @change="getDeviceList" multiple label="Статус"></v-select>
    </v-col>

    <v-col cols="12" sm="6" md="3">
      <v-text-field v-model="search" append-icon="mdi-magnify" label="Поиск" single-line hide-details> </v-text-field>
    </v-col>
    <v-data-table :headers="headers" :items="showListDeviceStatus" :search="search" :loading="isLoading">
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

        <!-- <v-btn icon @click="onDelete(item.id)">
          <v-icon>mdi-trash-can-outline</v-icon>
        </v-btn> -->
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
  props: {},

  data: () => ({
    listStatus: [STATUSES.NEW, STATUSES.APPROVED, STATUSES.REJECTED],
    edit: true,
    search: '',
    admin: ['admin'],
    employee_security_chief: ['employee_security_chief']
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

      if (this.hasAccessRole(this.admin)) {
        head.push({ text: 'Статус', value: 'status', sortable: false })
        head.push({ text: 'Действия', value: 'actions', sortable: false })
        head.push({ text: 'Подтверждение', value: 'approves', sortable: false })
      } else if (this.hasAccessRole(this.employee_security_chief)) {
        head.push({ text: 'Статус', value: 'status', sortable: false })
        head.push({ text: 'Подтверждение', value: 'approves', sortable: false })
      }

      return head
    },

    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj']('getDeviceList')
    },

    statuses: {
      get() {
        return this.$store.state.incomeDevice.statuses
      },
      set(newValue) {
        this.$store.commit('incomeDevice/changeStatuses', newValue)
        console.log(newValue)
      }
    },

    hasAccessRole() {
      return this.$store.getters['user/hasAccessRole']
    }
  },

  async mounted() {
    if (this.showListDeviceStatus && this.showListDeviceStatus.length == 0) {
      await this.$withLoadingIndicator(async () => await this.$store.dispatch('incomeDevice/getListDeviceStatus', this.statuses), ['getDeviceList'])
    }
  },

  methods: {
    getDeviceList() {
      this.$store.dispatch('incomeDevice/getListDeviceStatus', this.statuses)
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
