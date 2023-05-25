<template>
    <v-card>
      <v-toolbar>
        <v-toolbar-title>Список текущих проишествий</v-toolbar-title>
        <v-spacer />
        <v-btn 
          @click="openModal"
          color="primary"
          outlined
        >Добавить проишествие</v-btn>
      </v-toolbar>

      <v-card-text>
        <EventOpenTable :items="openEventList"/>
      </v-card-text>

      <EventIncomeModal />
    </v-card>
</template>

<script>
import EventOpenTable from '@/components/events/EventOpenTable.vue'
import EventIncomeModal from '@/components/events/EventIncomeModal.vue'

export default {
  components: {
    EventOpenTable,
    EventIncomeModal
  },

  computed: {
    openEventList() {
      return this.$store.state.incomeEvent.openEventList
    }
  },

  methods: {
    openModal() {
      this.$store.commit('incomeEvent/openAddModal')
    }
  },

  mounted() {
    this.$store.dispatch('incomeEvent/getOpenEventList')
  }
}
</script>