<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Администрирование</v-toolbar-title>
      <v-spacer />
      <v-btn color="primary" outlined @click="openModal"> Добавить пользователя </v-btn>
    </v-toolbar>

    <v-card-text>
      <AdminOpenTable />
    </v-card-text>

    <AdminIncomeModal />
  </v-card>
</template>

<script>
import AdminOpenTable from './components/AdminOpenTable.vue'
import AdminIncomeModal from './components/AdminIncomeModal.vue'

export default {
  components: {
    AdminIncomeModal,
    AdminOpenTable
  },

  methods: {
    openModal() {
      this.$store.commit('user/openAddModal')
    }
  }
}
</script>
