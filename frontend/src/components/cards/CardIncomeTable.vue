<template>
  <div>
    <v-data-table :headers="headers" :items="items" :loading="isLoading">
      <template #[`item.decided`]="{ item }">
        <v-btn outlined small color="success" :disabled="disabled" @click="decided(item.id)"> Вернуть </v-btn>
      </template>

      <template #[`item.employee`]="{ item }">
        {{ printName(item.employee) }}
      </template>

      <template #[`item.card`]="{ item }">
        {{ item.card.number }}
      </template>

      <template #[`item.inTime`]="{ item }">
        {{ $moment(item.inTime).format('HH:mm DD.MM.YYYY') }}
      </template>

      <template #[`item.actions`]="{ item }">
        <v-btn icon :disabled="disabled" @click="onDelete(item.id)">
          <v-icon>mdi-trash-can-outline</v-icon>
        </v-btn>
      </template>

      <template #no-data>
        <p>Все карты доступа на своем месте...</p>
      </template>
    </v-data-table>

    <ConfirmModal :is-open="confimDeleteOpen" :on-close="closeConfirmDelete" :on-confirm="onConfirmDelete">
      <v-subheader>Вы уверены, что хотите удалить данный элемент?</v-subheader>
    </ConfirmModal>
  </div>
</template>

<script>
import peopleHelper from '@/services/helpers/people.js'
import ConfirmModal from '@/components/app/modals/ConfirmModal.vue'

export default {
  components: {
    ConfirmModal
  },
  props: {
    items: Array,
    disabled: {
      type: Boolean,
      default: () => false
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
        { text: 'Сотрудник', value: 'employee', sortable: false },
        { text: 'Номер карты', align: 'start', value: 'card' },
        { text: 'Дата выдачи', value: 'inTime' }
      ]
      if (this.hasAccessRole(this.security)) {
        head.push({ text: 'Возврат', value: 'decided', sortable: false })
        head.push({ text: 'Действия', value: 'actions', sortable: false })
      }
      return head
    },
    hasAccessRole() {
      return this.$store.getters['user/hasAccessRole']
    }
  },

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
