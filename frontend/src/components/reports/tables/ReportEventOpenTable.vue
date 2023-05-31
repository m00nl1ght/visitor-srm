<template>
  <v-data-table
    :headers="headers"
    :items="items"
  >
    <template #[`item.inTime`]="{item}">
      {{ $moment(item.inTime).format('hh:mm DD.MM.YYYY') }}
    </template>

    <template #no-data>
      <p>Проишествия не происходили...</p>
    </template>
  </v-data-table>
</template>

<script>
export default {
  props: {
    items: Array
  },

  data: () => ({
    headers: [
      {
        text: 'Описание',
        align: 'start',
        value: 'description'
      },
      { text: 'Комментарий', value: 'comment', sortable: false },
      { text: 'Дата', value: 'inTime' }
    ]
  })
}
</script>
