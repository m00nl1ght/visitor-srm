<template>
    <v-card>
      <v-toolbar>
        <v-toolbar-title>Список автомобилей на объекте</v-toolbar-title>
        <v-spacer />
        <v-btn 
          @click="openModal"
          color="primary"
          outlined
        >Добавить новый автомобиль</v-btn>
      </v-toolbar>

      <v-card-text>
        <CarsIncomeList 
          v-if="incomeCarList && incomeCarList.length > 0"
          :items="incomeCarList"
          @printCard="printCard"
        />

        <p v-else>Территория пуста, все посетители на автомобилях дома...</p>
      </v-card-text>

      <CarPrintCardModal 
        :isOpen="isOpenPrintModal"
        :onClose="() => isOpenPrintModal = false"
        :printCardValue="printCardValue"
      />

      <CarIncomeModal />
    </v-card>
</template>

<script>
import CarsIncomeList from "@/components/cars/CarsIncomeList.vue"
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
    printCardValue: {}
  }),

  computed: {
    incomeCarList() {
      return this.$store.state.incomeCar.incomeCarList
    }
  },

  methods: {
    openModal() {
      this.$store.commit('incomeCar/openModal')
    },

    printCard({id}) {
      this.printCardValue = this.incomeCarList.find(item => item.id == id)
      this.isOpenPrintModal = true
    }
  },

  mounted() {
    this.$store.dispatch('incomeCar/getIncomeCarList')
  }
}
</script>