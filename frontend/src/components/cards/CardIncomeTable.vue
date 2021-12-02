<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="items"
    >
      <template #[`item.decided`]="{item}">
        <v-btn @click="decided(item.id)" outlined small color="success">Вернули</v-btn>
      </template>

      <template #[`item.employee`]="{item}">
        {{ printName(item.employee) }}
      </template>

      <template #[`item.card`]="{item}">
        {{ item.card.number }}
      </template>

      <template #[`item.inTime`]="{item}">
        {{ $moment(item.inTime).format('hh:mm DD.MM.YYYY') }}
      </template>

      <template #[`item.actions`]="{ item }">
          <v-btn
            @click="onDelete(item.id)"
            icon
          >
            <v-icon>mdi-trash-can-outline</v-icon>
          </v-btn>
      </template>

      <template v-slot:no-data>
        <p>Все карты доступа на своем месте...</p>
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
import peopleHelper from '@/services/helpers/people.js'
import ConfirmModal from '@/components/app/modals/ConfirmModal.vue'

export default {
  props: {
    items: Array
  },

  components: {
    ConfirmModal
  },

  data: () => ({
    headers: [
      {
        text: 'Возврат',
        value: 'decided',
        sortable: false
      },
      {
        text: 'Сотрудник',
        value: 'employee',
        sortable: false
      },
      {
        text: 'Номер карты',
        align: 'start',
        value: 'card',
      },
      { text: 'Дата выдачи', value: 'inTime' },
      { text: 'Действия', value: 'actions', sortable: false },
    ],

    confimDeleteOpen: false,
    deleteItemId: null
  }),

  methods: {
    printName(person) {
      return peopleHelper.getShortName(person)
    },
    decided(id) {
      this.$store.dispatch('incomeCard/returnIncomeCard', id)
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
      this.$store.dispatch('incomeCard/deleteIncomeCard', this.deleteItemId)
      this.closeConfirmDelete()
    }
  }
}
</script>