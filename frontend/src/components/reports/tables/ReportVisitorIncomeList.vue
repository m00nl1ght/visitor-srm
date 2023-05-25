<template>
  <v-data-table
    :headers="headers"
    :items="items"
  >
    <template #[`item.visitorName`]="{ item }">
      {{ printFullName(item.visitor) }}
    </template>

    <template #[`item.inTime`]="{ item }">
      {{ $moment(item.inTime).format('HH:mm DD.MM.YYYY') }}
    </template>

    <template #[`item.outTime`]="{ item }">
      {{ item.outTime ? $moment(item.outTime).format('HH:mm DD.MM.YYYY') : '' }}
    </template>

    <template #no-data>
      <p>Данные отсутствуют...</p>
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
    }
  },

  data: () => ({
    headers: [
      {
        text: 'ФИО',
        align: 'start',
        value: 'visitorName'
      },
      { text: 'Телефон', value: 'visitor.phone' },
      { text: 'Вход', value: 'inTime' },
      { text: 'Выход', value: 'outTime' }
    ],
    exitTime: {}
  }),

  methods: {
    printFullName(person) {
      return peopleHelper.getFullName(person)
    }
  }
}
</script>
