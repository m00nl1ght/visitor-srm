<template>
  <div>
    <v-data-table :headers="headers" :items="items" :single-expand="true" item-key="id" show-expand class="elevation-1" :loading="isLoading">
      <template #[`item.inTime`]="{ item }">
        {{ $moment(item.inTime).format('hh:mm DD.MM.YYYY') }}
      </template>

      <template #[`item.comment`]="{ item }">
        <span class="comment_overflow">{{ item.comment }}</span>
      </template>

      <template #[`item.actions`]="{ item }">
        <v-btn icon :disabled="disabled" @click="onEdit(item)">
          <v-icon>mdi-pencil-outline</v-icon>
        </v-btn>

        <v-btn icon :disabled="disabled" @click="onDelete(item.id)">
          <v-icon>mdi-trash-can-outline</v-icon>
        </v-btn>
      </template>

      <template #expanded-item="{ item }">
        <td :colspan="990">
          <p class="pt-2"><span class="font-weight-bold">Описание:</span> {{ item.description }}</p>
          <p><span class="font-weight-bold">Комментарий:</span> {{ item.comment }}</p>
        </td>
      </template>

      <template #no-data>
        <p>Проишествия не происходили...</p>
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
    },
    isLoading: {
      type: Boolean,
      default: false
    }
  },

  data: () => ({
    security: ['security'],
    confimDeleteOpen: false,
    deleteItemId: null
  }),

  computed: {
    headers() {
      let head = [
        { text: 'Описание', align: 'start', value: 'description', width: 200 },
        { text: 'Комментарий', value: 'comment', sortable: false, width: 1000 },
        { text: 'Дата', value: 'inTime', width: 150 }
      ]
      if (this.hasAccessRole(this.security)) {
        head.push({ text: 'Действия', value: 'actions', sortable: false, width: 120 })
      }
      return head
    },

    hasAccessRole() {
      return this.$store.getters['user/hasAccessRole']
    }
  },

  methods: {
    decided(id) {
      console.log(id)
    },

    onEdit(item) {
      this.$store.commit('incomeEvent/openEditModal', item.id)
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
      this.$store.dispatch('incomeEvent/deleteEvent', this.deleteItemId)
      this.closeConfirmDelete()
    }
  }
}
</script>

<style scoped>
.comment_overflow {
  margin-left: -5px;
  display: block;
  max-width: 1000px;
  white-space: nowrap; /* Запрещаем перенос строк */
  overflow: hidden; /* Обрезаем все, что не помещается в область */
  padding: 5px; /* Поля вокруг текста */
  text-overflow: ellipsis; /* Добавляем многоточие */
}
</style>
