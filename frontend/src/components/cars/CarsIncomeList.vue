<template>
  <v-data-table :headers="headers" :items="items" :loading="isLoading">
    <template #[`item.printBtn`]="{ item }">
      <v-btn :disabled="disabled" icon @click="printCard({ id: item.id })">
        <v-icon>mdi-printer</v-icon>
      </v-btn>
    </template>

    <template #[`item.visitorName`]="{ item }">
      {{ printFullName(item.visitor) }}
    </template>

    <template #[`item.inTime`]="{ item }">
      {{ $moment(item.inTime).format('YYYY.MM.DD hh:mm') }}
    </template>

    <template #[`item.actions`]="{ item }">
      <div class="d-flex align-center">
        <v-text-field :value="exitTime[item.id] ? exitTime[item.id] : null" type="time" @change="(value) => setExitTime({ id: item.id, value })" />

        <v-btn outlined small color="primary" class="ml-5" :disabled="disabled" @click="exitCar({ id: item.id })">
          <v-icon small class="mr-2"> mdi-exit-run </v-icon>
          Вышел
        </v-btn>
      </div>
    </template>

    <template #no-data>
      <p>Территория пуста, все посетители на автомобилях дома...</p>
    </template>
  </v-data-table>
</template>

<script>
import peopleHelper from '@/services/helpers/people.js'

export default {
  props: {
    items: {
      type: Array,
      default: () => []
    },
    disabled: {
      type: Boolean,
      default: false
    },
    isLoading: {
      type: Boolean,
      default: false
    }
  },

  data: () => ({
    headers: [
      {
        text: '',
        value: 'printBtn'
      },
      {
        text: 'ФИО',
        align: 'start',
        value: 'visitorName'
      },
      { text: 'Номер авто', value: 'visitor.car.regNumber' },
      { text: 'Телефон', value: 'visitor.phone' },
      { text: 'Вход', value: 'inTime' },
      { text: 'Выход', value: 'actions', sortable: false }
    ],
    exitTime: {}
  }),

  methods: {
    exitCar({ id }) {
      this.$store.dispatch('incomeCar/exitCar', {
        id,
        time: this.exitTime[id] ? this.exitTime[id] : null
      })
    },

    setExitTime({ id, value }) {
      this.exitTime[id] = value
    },

    printCard({ id }) {
      this.$emit('printCard', { id })
    },

    printFullName(person) {
      return peopleHelper.getFullName(person)
    }
  }
}
</script>
