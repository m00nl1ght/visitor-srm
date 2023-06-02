<template>
  <v-data-table :headers="headers" :items="items">
    <template #[`item.status`]="{ item }">
      <v-chip class="ma-2" :color="item.outTime === null ? 'red' : 'green'" text-color="black" outlined>
        {{ item.outTime === null ? 'Не решено' : 'Решено' }}
      </v-chip>
    </template>

    <template #[`item.system`]="{ item }">
      {{ item.systemAlarmList.title }}
    </template>

    <template #[`item.inTime`]="{ item }">
      {{ $moment(item.inTime).format('hh:mm DD.MM.YYYY') }}
    </template>

    <template #no-data>
      <p>Нерешенные неисправности отсутствуют...</p>
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
      { text: 'Статус', value: 'status' },
      {
        text: 'Система',
        align: 'start',
        value: 'system',
        sortable: false
      },
      { text: 'Описание', value: 'title' },
      { text: 'Место', value: 'place', sortable: false },
      { text: 'Комментарий', value: 'comment', sortable: false },
      { text: 'Дата возникновения', value: 'inTime' }
    ],

    confimDeleteOpen: false,
    deleteItemId: null
  })
}
</script>
