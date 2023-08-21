<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список автомобилей на объекте</v-toolbar-title>
      <v-spacer />
      <v-btn v-if="hasAccessRole(security)" color="primary" outlined @click="openModal"> Добавить новый автомобиль </v-btn>
    </v-toolbar>

    <v-card-text>
      <CarsIncomeList :items="incomeCarList" @printCard="printCard" :isLoading="isLoading" />
    </v-card-text>

    <CarPrintCardModal :is-open="isOpenPrintModal" :on-close="() => (isOpenPrintModal = false)" :print-card-value="printCardValue" />

    <CarIncomeModal />
  </v-card>
</template>

<script>
import CarsIncomeList from '@/components/cars/CarsIncomeList.vue'
import CarIncomeModal from '@/components/cars/CarIncomeModal.vue'
import CarPrintCardModal from '@/components/cars/CarPrintCardModal.vue'

export default {
  components: {
    CarIncomeModal,
    CarPrintCardModal,
    CarsIncomeList
  },

  data: () => ({
    isOpenPrintModal: false,
    printCardValue: {},
    security: ['security'],
  }),

  computed: {
    incomeCarList() {
      return this.$store.state.incomeCar.incomeCarList
    },

    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj']('getIncomeCarList')
    },

    hasAccessRole() {
      return this.$store.getters['user/hasAccessRole']
    }
  },

  async mounted() {
    if (this.incomeCarList && this.incomeCarList == 0) {
      await this.$withLoadingIndicator(async () => await this.$store.dispatch('incomeCar/getIncomeCarList'), ['getIncomeCarList'])
    }
  },

  methods: {
    openModal() {
      this.$store.commit('incomeCar/openModal')
    },

    printCard({ id }) {
      this.printCardValue = this.incomeCarList.find((item) => item.id === id)
      this.isOpenPrintModal = true
    }
  }
}
</script>
