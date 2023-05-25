<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список текущих проишествий</v-toolbar-title>
      <v-spacer />
      <v-btn 
        color="primary"
        outlined
        @click="openModal"
      >
        Добавить проишествие
      </v-btn>
    </v-toolbar>

    <v-card-text>
      <EventOpenTable :items="openEventList" />
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

  mounted() {
    this.$store.dispatch('incomeEvent/getOpenEventList')
  },

  methods: {
    openModal() {
      this.$store.commit('incomeEvent/openAddModal')
    }
  }
}
</script>