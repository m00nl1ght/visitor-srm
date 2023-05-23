<template>
    <v-data-table
      :headers="headers"
      :items="items"
    >
      <template #[`item.system`]="{item}">
        {{ item.systemAlarmList.title }}
      </template>

      <template #[`item.inTime`]="{item}">
        {{ $moment(item.inTime).format('hh:mm DD.MM.YYYY') }}
      </template>

      <template v-slot:no-data>
        <p>Нерешенные неисправности отсутствуют...</p>
      </template>
    </v-data-table>
</template>

<script>
export default {
  props: {
    items: Array,
  },

  data: () => ({
    headers: [
      {
        text: 'Система',
        align: 'start',
        value: 'system',
        sortable: false
      },
      { text: 'Описание11111', value: 'title' },
      { text: 'Место', value: 'place', sortable: false},
      { text: 'Комментарий', value: 'comment', sortable: false },
      { text: 'Дата возникновения', value: 'inTime'}
    ],

    confimDeleteOpen: false,
    deleteItemId: null
  })
}
</script>