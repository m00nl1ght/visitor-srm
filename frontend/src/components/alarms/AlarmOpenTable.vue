<template>
  <div>
    <v-data-table :headers="headers" :items="items" :single-expand="true" item-key="title" show-expand class="elevation-1">
      <template #[`item.decided`]="{ item }">
        <v-btn :disabled="disabled" outlined small color="success" @click="decided(item.id)"> Решено </v-btn>
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

      <template #expanded-item="{ item }">
        <td :colspan="990">
          <p class="pt-2"><span class="font-weight-bold">Описание:</span> {{ item.title }}</p>
          <p><span class="font-weight-bold">Место:</span> {{ item.place }}</p>
          <p><span class="font-weight-bold">Комментарий:</span> {{ item.comment }}</p>
        </td>
      </template>

      <template #[`item.actions`]="{ item }">
        <v-btn icon :disabled="disabled" @click="onEdit(item.id)">
          <v-icon>mdi-pencil-outline</v-icon>
        </v-btn>

        <v-btn icon :disabled="disabled" @click="onDelete(item.id)">
          <v-icon>mdi-trash-can-outline</v-icon>
        </v-btn>
      </template>

      <template #no-data>
        <p>Нерешенные неисправности отсутствуют...</p>
      </template>
    </v-data-table>

    <ConfirmModal :is-open="confimDeleteOpen" :on-close="closeConfirmDelete" :on-confirm="onConfirmDelete">
      <v-subheader>Вы уверены, что хотите удалить данный элемент?</v-subheader>
    </ConfirmModal>
  </div>
</template>

<script>
import ConfirmModal from '@/components/app/modals/ConfirmModal.vue'

export default {
  components: {
    ConfirmModal
  },
  props: {
    items: Array,
    disabled: {
      type: Boolean,
      default: false
    }
  },

  data: () => ({
    headers: [
      { text: 'Решено', value: 'decided', sortable: false, width: 100 },
      { text: 'Система', align: 'start', value: 'system', sortable: false, width: 200 },
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

<style scoped>
.comment_overflow {
  margin-left: -5px;
  display: block;
  max-width: 200px;
  white-space: nowrap; /* Запрещаем перенос строк */
  overflow: hidden; /* Обрезаем все, что не помещается в область */
  padding: 5px; /* Поля вокруг текста */
  text-overflow: ellipsis; /* Добавляем многоточие */
}
</style>
