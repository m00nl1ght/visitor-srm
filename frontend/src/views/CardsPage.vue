<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список выданых карт</v-toolbar-title>
      <v-spacer />
      <v-btn 
        color="primary"
        outlined
        @click="openModal"
      >
        Выдать карту
      </v-btn>
    </v-toolbar>

    <v-card-text>
      <CardIncomeTable 
      v-if="(incomeCardList && incomeCardList.length > 0) || isLoading"
      :items="incomeCardList"
      :isLoading="isLoading" />
    </v-card-text>

    <CardIncomeModal />
  </v-card>
</template>

<script>
import CardIncomeTable from "@/components/cards/CardIncomeTable.vue"
import CardIncomeModal from "@/components/cards/CardIncomeModal.vue"

export default {
  components: {
    CardIncomeTable,
    CardIncomeModal
  },

  computed: {
    incomeCardList() {
      return this.$store.state.incomeCard.incomeCardList
    },

    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj']('getIncomeCardList')
    }
  },

  async mounted() {
    if (this.incomeCardList && this.incomeCardList == 0) {
      await this.$withLoadingIndicator(async () => await this.$store.dispatch('incomeCard/getIncomeCardList'), ['getIncomeCardList'])
    }
    
  },

  methods: {
    openModal() {
      this.$store.commit('incomeCard/openAddModal')
    }
  }
}
</script>