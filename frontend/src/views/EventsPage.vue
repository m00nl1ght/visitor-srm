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
      <EventOpenTable 
      v-if="(openEventList && openEventList.length > 0) || isLoading"
      :items="openEventList" 
      :isLoading="isLoading"/>
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
    },

    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj']('getOpenEventList')
    }
  },

  async mounted() {
    if (this.openEventList && this.openEventList == 0) {
      await this.$withLoadingIndicator(async () => await this.$store.dispatch('incomeEvent/getOpenEventList'), ['getOpenEventList'])
    }
    
  },

  methods: {
    openModal() {
      this.$store.commit('incomeEvent/openAddModal')
    }
  }
}
</script>