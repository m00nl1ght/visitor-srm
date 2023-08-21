<template>
  <v-data-table :headers="headers" :items="items" :loading="isLoading" :search="search">
    <template v-slot:top>
      <v-text-field v-model="search" label="Поиск" class="mx-4"></v-text-field>
    </template>

    <template #[`item.category`]="{ item }">
      <span>{{ item.cardCategory.description }}</span>
    </template>

    <template #[`item.actions`]="{ item }">
      <v-btn icon @click="$emit('onEdit', item)" title="Редактировать">
        <v-icon>mdi-pencil-outline</v-icon>
      </v-btn>

      <v-btn icon @click="$emit('onDelete', item.id)" title="Удалить">
        <v-icon>mdi-trash-can-outline</v-icon>
      </v-btn>
    </template>

    <template #no-data>
      <p>Карты доступа отсутсвуют...</p>
    </template>
  </v-data-table>
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      default: () => []
    },
    isLoading: Boolean
  },

  data() {
    return {
      search: '',
      headers: [
        { text: 'Номер', value: 'number' },
        { text: 'Категория', value: 'category', sortable: false },
        { text: 'Выдана', value: 'issued' },
        { text: 'Действия', value: 'actions', sortable: false }
      ]
    }
  }
}
</script>
