<template>
  <v-card-text>
    <!-- <v-btn @click="getListUser">GET</v-btn>
    <v-btn @click="showUserList">SHOW</v-btn> -->
    <v-data-table :headers="headers" :items="showUserList">
      <template #[`item.role`]="{ item }">
        <li v-for="roles in item.role" v-bind:key="roles.id">{{ roles.title }}</li>
      </template>

      <template #[`item.actions`]="{ item }">
        <v-btn icon @click="onEdit(item)">
          <v-icon>mdi-pencil-outline</v-icon>
        </v-btn>

        <v-btn icon @click="onDelete(item.id)">
          <v-icon>mdi-trash-can-outline</v-icon>
        </v-btn>
      </template>

      <template #no-data>
        <p>Пользователи отсутсвуют...</p>
      </template>
    </v-data-table>
  </v-card-text>
</template>

<script>
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

  computed: {
    showUserList() {
      return this.$store.state.user.userList
    }
  },

  mounted() {
    this.$store.dispatch('user/getUserList')
  },

  methods: {
    onEdit() {},
    onDelete(id) {
      this.$store.dispatch('user/deleteUser', id)
    }
  }
}
</script>
