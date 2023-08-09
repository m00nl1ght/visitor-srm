<template>
  <v-card-text>
    <v-data-table :headers="headers" :items="showUserList" :loading="isLoading">
      <template #[`item.role`]="{ item }">
        <li v-for="roles in item.role" v-bind:key="roles.id">{{ roles.title }}</li>
      </template>

      <template #[`item.actions`]="{ item }">
        <!-- <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <v-btn v-bind="attrs" v-on="on" icon @click="onEdit(item)">
              <v-icon>mdi-pencil-outline</v-icon>
            </v-btn>
          </template>
          <span>Редактировать</span>
        </v-tooltip> -->

        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <v-btn v-bind="attrs" v-on="on" icon @click="onEditRole(item)">
              <v-icon>mdi-account-plus</v-icon>
            </v-btn>
          </template>
          <span>Изменить роль</span>
        </v-tooltip>

        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <v-btn v-bind="attrs" v-on="on" icon @click="onDelete(item.id)">
              <v-icon>mdi-trash-can-outline</v-icon>
            </v-btn>
          </template>
          <span>Удалить</span>
        </v-tooltip>
      </template>

      <template #no-data>
        <p>Пользователи отсутсвуют...</p>
      </template>
    </v-data-table>
    <AdminIncomeModalRoles />
    <ConfirmModal :is-open="confimDeleteOpen" :on-close="closeConfirmDelete" :on-confirm="onConfirmDelete">
      <v-subheader>Вы уверены, что хотите удалить данный элемент?</v-subheader>
    </ConfirmModal>
  </v-card-text>

</template>

<script>
import AdminIncomeModalRoles from '@/components/admins/AdminIncomeModalRoles.vue'
import ConfirmModal from '@/components/app/modals/ConfirmModal.vue'

export default {
  data: () => ({
    headers: [
      { text: 'ID', value: 'id', sortable: false },
      { text: 'Имя', value: 'name', sortable: false },
      { text: 'email', value: 'email', sortable: false },
      { text: 'Роль', value: 'role', sortable: false },
      { text: 'Действия', value: 'actions', sortable: false }
    ],

    confimDeleteOpen: false,
    deleteItemId: null
  }),

  components: {
    AdminIncomeModalRoles,
    ConfirmModal
  },

  computed: {
    showUserList() {
      return this.$store.state.user.userList
    },
    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj']('getUserList')
    }
  },

  async mounted() {
    if (this.showUserList && this.showUserList == 0) {
      await this.$withLoadingIndicator(async () => await this.$store.dispatch('user/getUserList'), ['getUserList'])
    }
  },

  methods: {
    onEdit() {
      this.$store.commit('user/openEditModal')
    },

    onEditRole(item) {
      this.$store.commit('user/openEditModalRoles', item)
      console.log('RoleITEM', item)
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
      this.$store.dispatch('user/deleteUser', this.deleteItemId)
      this.closeConfirmDelete()
    }
  }
}
</script>
