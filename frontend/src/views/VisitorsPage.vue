<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список посетителей на объекте</v-toolbar-title>
      <v-spacer />
      <v-btn color="primary" outlined @click="openModal"> Добавить нового посетителя </v-btn>
      <VisitorIncomeModal />
    </v-toolbar>

    <v-card-text>
      <VisitorsIncomeList
        v-if="(incomeVisitorList && incomeVisitorList.length > 0) || isLoading"
        :items="incomeVisitorList"
        @printCard="printCard"
        :isLoading="isLoading"
      />

      <p v-else>Территория пуста, все посетители дома...</p>
    </v-card-text>

    <VisitorPrintCardModal :is-open="isOpenPrintModal" :on-close="() => (isOpenPrintModal = false)" :print-card-value="printCardValue" />
  </v-card>
</template>

<script>
import VisitorsIncomeList from '@/components/visitors/VisitorsIncomeList.vue'
import VisitorIncomeModal from '@/components/visitors/VisitorIncomeModal.vue'
import VisitorPrintCardModal from '@/components/visitors/VisitorPrintCardModal.vue'

export default {
  components: {
    VisitorsIncomeList,
    VisitorIncomeModal,
    VisitorPrintCardModal
  },

  data: () => ({
    isOpenPrintModal: false,
    printCardValue: {}
  }),

  computed: {
    incomeVisitorList() {
      return this.$store.state.incomeVisitor.incomeVisitorList
    },

    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj']('getIncomeVisitorList')
    }
  },

  async mounted() {
    await this.$withLoadingIndicator(async () => await this.$store.dispatch('incomeVisitor/getIncomeVisitorList'), ['getIncomeVisitorList'])
  },

  methods: {
    openModal() {
      this.$store.commit('incomeVisitor/openModal')
    },

    printCard({ id }) {
      this.printCardValue = this.incomeVisitorList.find((item) => item.id == id)
      this.isOpenPrintModal = true
    }
  }
}
</script>
