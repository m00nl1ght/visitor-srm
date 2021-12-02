<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="items"
    >
      <template #[`item.inTime`]="{item}">
        {{ $moment(item.inTime).format('hh:mm DD.MM.YYYY') }}
      </template>

      <template #[`item.actions`]="{ item }">
          <v-btn
            @click="onEdit(item.id)"
            icon
            :disabled="disabled"
          >
            <v-icon>mdi-pencil-outline</v-icon>
          </v-btn>

          <v-btn
            @click="onDelete(item.id)"
            icon 
            :disabled="disabled"
          >
            <v-icon>mdi-trash-can-outline</v-icon>
          </v-btn>
      </template>

      <template v-slot:no-data>
        <p>Проишествия не происходили...</p>
      </template>
    </v-data-table>

    <ConfirmModal
      :isOpen="confimDeleteOpen"
      :onClose="closeConfirmDelete"
      :onConfirm="onConfirmDelete"
    >
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
        text: 'Описание',
        align: 'start',
        value: 'description',
      },
      { text: 'Комментарий', value: 'comment', sortable: false },
      { text: 'Дата', value: 'inTime'},
      { text: 'Действия', value: 'actions', sortable: false },
    ],

    confimDeleteOpen: false,
    deleteItemId: null
  }),

  methods: {
    decided(id) {
      console.log(id);
    },

    onEdit(id) {
      this.$store.commit('incomeEvent/openEditModal', id)
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