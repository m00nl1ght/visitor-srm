<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="items"
    >
      <template #[`item.decided`]="{item}">
        <v-btn 
          @click="decided(item.id)" 
          :disabled="disabled"
          outlined 
          small 
          color="success"
        >Решено</v-btn>
      </template>

      <template #[`item.system`]="{item}">
        {{ item.systemAlarmList.title }}
      </template>

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
        <p>Нерешенные неисправности отсутствуют...</p>
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
      { text: 'Место', value: 'place', sortable: false},
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