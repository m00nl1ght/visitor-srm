<template>
  <v-data-table :headers="headers" :items="items">
    <template #[`item.employee`]="{item}">
      {{ printName(item.employee) }}
    </template>

    <template #[`item.card`]="{item}">
      {{ item.card.number }}
    </template>

    <template #[`item.inTime`]="{item}">
      {{ $moment(item.inTime).format('HH:mm DD.MM.YYYY') }}
    </template>

    <template v-slot:no-data>
      <p>Все карты доступа на своем месте...</p>
    </template>
  </v-data-table>
</template>

<script>
import peopleHelper from '@/services/helpers/people.js'

export default {
  props: {
    items: Array,
    disabled: {
      type: Boolean,
      default: () => false
    }
  },

  data: () => ({
    headers: [
      {
        text: 'Сотрудник',
        value: 'employee',
        sortable: false
      },
      {
        text: 'Номер карты',
        align: 'start',
        value: 'card'
      },
      { text: 'Дата выдачи', value: 'inTime' }
    ]
  }),

  methods: {
    printName(person) {
      return peopleHelper.getShortName(person)
    }
  }
}
</script>
