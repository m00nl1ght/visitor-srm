<template>
  <div>
    <v-data-table :headers="headers" :items="items" :single-expand="true" item-key="title" show-expand class="elevation-1">
      <template #[`item.decided`]="{ item }">
        <v-btn @click="decided(item.id)" :disabled="disabled" outlined small color="red">Решить</v-btn>
      </template>

      <template #[`item.system`]="{ item }">
        {{ item.systemAlarmList.title }}
      </template>

      <template #[`item.comment`]="{ item }">
        <span class="comment_overflow">{{ item.comment }}</span>
      </template>

      <template #[`item.inTime`]="{ item }">
        {{ $moment(item.inTime).format('hh:mm DD.MM.YYYY') }}
      </template>

      <template v-slot:expanded-item="{ item }">
        <td :colspan="990">
          <p class="v-data-table_title"><b>Описание:</b> {{ item.title }}</p>
          <p><b>Место:</b> {{ item.place }}</p>
          <p><b>Комментарий:</b> {{ item.comment }}</p>
        </td>
      </template>

      <template #[`item.actions`]="{ item }">
        <v-btn @click="onEdit(item.id)" icon :disabled="disabled">
          <v-icon>mdi-pencil-outline</v-icon>
        </v-btn>

        <v-btn @click="onDelete(item.id)" icon :disabled="disabled">
          <v-icon>mdi-trash-can-outline</v-icon>
        </v-btn>
      </template>
      <template v-slot:no-data>
        <p>Нерешенные неисправности отсутствуют...</p>
      </template>
    </v-data-table>

    <ConfirmModal :isOpen="confimDeleteOpen" :onClose="closeConfirmDelete" :onConfirm="onConfirmDelete">
      <v-subheader>Вы уверены, что хотите удалить данный элемент?</v-subheader>
    </ConfirmModal>
  </div>
</template>

<script>
import ConfirmModal from '@/components/app/modals/ConfirmModal.vue'

export default {
  props: {
    items: Array,
    disabled: {
      type: Boolean,
      default: false
    }
  },

  components: {
    ConfirmModal
  },

  data: () => ({
    headers: [
      {
        text: 'Решено',
        value: 'decided',
        sortable: false
      },
      {
        text: 'Система',
        align: 'start',
        value: 'system',
        sortable: false
      },
      { text: 'Описание', value: 'title' },
      { text: 'Место', value: 'place', sortable: false },
      { text: 'Комментарий', value: 'comment', sortable: false, width: 200 },
      { text: 'Дата', value: 'inTime' },
      { text: 'Действия', value: 'actions', sortable: false }
    ],

    confimDeleteOpen: false,
    deleteItemId: null
  }),

  methods: {
    decided(id) {
      this.$store.dispatch('incomeAlarm/closeAlarm', id)
    },

    onEdit(id) {
      console.log(this.item)
      this.$store.commit('incomeAlarm/openEditModal', id)
    },

    onDelete(id) {
      this.deleteItemId = id
      this.confimDeleteOpen = true
    },

    closeConfirmDelete() {
      this.deleteItemId = null
      this.confimDeleteOpen = false
    },

    onConfirmDelete() {
      this.$store.dispatch('incomeAlarm/deleteAlarm', this.deleteItemId)
      this.closeConfirmDelete()
    }
  }
}
</script>

<style>
.comment_overflow {
  margin-left: -5px;
  display: block;
  max-width: 200px;
  white-space: nowrap; /* Запрещаем перенос строк */
  overflow: hidden; /* Обрезаем все, что не помещается в область */
  padding: 5px; /* Поля вокруг текста */
  text-overflow: ellipsis; /* Добавляем многоточие */
}
.v-data-table_title {
  padding-top: 10px;
}
</style>
