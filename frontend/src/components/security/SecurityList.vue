<template>
    <v-card>
      <div class="d-flex justify-space-between align-center pr-5">
        <v-card-title>Список сотрудников охраны</v-card-title>

        <v-btn 
          @click="openModal"
          color="primary"
          outlined
        >Добавить сотрудника охраны</v-btn>

        <SecurityAddModal :title="modalTitle"/>
        <ConfirmModal 
          :isOpen="confirmModalOpen"
          :onConfirm="confirmDelete"
          :onClose="() => confirmModalOpen = false"
          :title="'Подтвердите удаление'"
        />
      </div>

      <v-card-text>
         <v-data-table
            :headers="headers"
            :items="securities"
          >
            <template #[`item.securityName`]="{ item }">
              {{ printFullName(item) }}
            </template>

            <template #[`item.actions`]="{ item }">
              <v-icon
                small
                class="mr-2"
                @click="editItem(item)"
              >
                mdi-pencil
              </v-icon>
              <v-icon
                small
                @click="deleteItem(item)"
              >
                mdi-delete
              </v-icon>
            </template>

            <template v-slot:no-data>
              <p>Данные отсутствуют...</p>

              <v-btn
                color="primary"
                @click="initialize"
              >
                Обновить
              </v-btn>
            </template>
          </v-data-table>
      </v-card-text>
    </v-card>
</template>

<script>
import SecurityAddModal from '@/components/security/SecurityAddModal.vue'
import ConfirmModal from '@/components/app/modals/ConfirmModal.vue'
import peopleHelper from '@/services/helpers/people.js'

export default {
  components: {
    SecurityAddModal,
    ConfirmModal
  },

  data: () => ({
    modalTitle: '',
    headers: [
      { align: 'start', text: 'ФИО', value: 'securityName' },
      { text: 'Категория', value: 'role.title'},
      { text: 'Редактировать', value: 'actions', sortable: false },
    ],
    confirmModalOpen: false,
    deleteItemId: null
  }),

  computed: {
    securities() {
      return this.$store.getters['security/securities']
    }
  },

  methods: {
    printFullName(person) {
      return peopleHelper.getFullName(person)
    },

    initialize() {
      this.$store.dispatch('security/getSecurities')
    },

    openModal() {
      this.modalTitle = "Добавить сотрудника"
      this.$store.commit('security/resetAddFormValue')
      this.$store.commit('security/setSecurityModalOpen', true)
    },

    editItem(item) {
      this.$store.commit('security/initAddFormValue', item)
      this.$store.commit('security/setSecurityModalOpen', true)
    },

    deleteItem(item) {
      this.deleteItemId = item.id
      this.confirmModalOpen = true
    },

    confirmDelete() {
      this.$store.dispatch('security/deleteSecurity', this.deleteItemId)
      this.confirmModalOpen = false
    }
  },
}
</script>