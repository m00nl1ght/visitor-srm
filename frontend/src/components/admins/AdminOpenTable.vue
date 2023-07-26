<template>
  <v-card-text>
    <!-- <v-btn @click="getListUser">GET</v-btn>
    <v-btn @click="showUserList">SHOW</v-btn> -->
    <v-data-table :headers="headers" :items="showUserList">
      <template #[`item.role`]="{ item }">
        <li v-for="roles in item.role" v-bind:key="roles.id">{{ roles.title }}</li>
      </template>

      <template #[`item.actions`]="{ item }">
        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <v-btn v-bind="attrs" v-on="on" icon @click="onEdit(item)">
              <v-icon>mdi-pencil-outline</v-icon>
            </v-btn>
          </template>
          <span>Редактировать</span>
        </v-tooltip>

        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <v-btn v-bind="attrs" v-on="on" icon @click="onDelete(item)">
              <v-icon>mdi-trash-can-outline</v-icon>
            </v-btn>
          </template>
          <span>Удалить</span>
        </v-tooltip>

        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <v-btn v-bind="attrs" v-on="on" icon @click="onEditRole(item)">
              <v-icon>mdi-account-plus</v-icon>
            </v-btn>
          </template>
          <span>Изменить роль</span>
        </v-tooltip>
      </template>

      <template #no-data>
        <p>Пользователи отсутсвуют...</p>
      </template>
    </v-data-table>
    <AdminIncomeModalRoles />
  </v-card-text>
</template>

<script>
import AdminIncomeModalRoles from '@/components/admins/AdminIncomeModalRoles.vue'

export default {
  data: () => ({
    headers: [
      { text: 'ID', value: 'id', sortable: false },
      { text: 'Имя', value: 'name', sortable: false },
      { text: 'email', value: 'email', sortable: false },
      { text: 'Роль', value: 'role', sortable: false },
      { text: 'Действия', value: 'actions', sortable: false }
    ]
  }),

  components: {
    AdminIncomeModalRoles
  },

  computed: {
    showUserList() {
      return this.$store.state.user.userList
    }
  },

  mounted() {
    this.$store.dispatch('user/getUserList')
  },

  methods: {
    onEdit() {
      this.$store.commit('user/openEditModal')
    },

    onDelete(id) {
      this.$store.dispatch('user/deleteUser', id)
    },

    onEditRole(item) {
      this.$store.commit('user/openEditModalRoles', item)
      console.log('RoleITEM', item)
    }
  }
}
</script>
