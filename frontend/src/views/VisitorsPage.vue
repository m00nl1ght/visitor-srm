<template>
    <v-card>
      <v-toolbar>
        <v-toolbar-title>Список посетителей на объекте</v-toolbar-title>
        <v-spacer />
        <v-btn 
          @click="openModal"
          color="primary"
          outlined
        >Добавить нового посетителя</v-btn>
      </v-toolbar>

      <v-card-text>
        <VisitorsIncomeList 
          v-if="incomeVisitorList && incomeVisitorList.length > 0"
          :items="incomeVisitorList"
          @printCard="printCard"
        />

        <p v-else>Территория пуста, все посетители дома...</p>
      </v-card-text>

      <VisitorPrintCardModal 
        :isOpen="isOpenPrintModal"
        :onClose="() => isOpenPrintModal = false"
        :printCardValue="printCardValue"
      />
      <VisitorIncomeModal />
    </v-card>
</template>

<script>
import VisitorsIncomeList from "@/components/visitors/VisitorsIncomeList.vue"
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
      return this.$store.getters['incomeVisitor/getIncomeVisitorList']
    }
  },

  methods: {
    openModal() {
      this.$store.commit('incomeVisitor/openModal')
    },

    printCard({id}) {
      this.printCardValue = this.incomeVisitorList.find(item => item.id == id)
      this.isOpenPrintModal = true
    }
  },

  mounted() {
    this.$store.dispatch('incomeVisitor/getIncomeVisitorList')
  }
}
</script>