<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список выданых карт</v-toolbar-title>
      <v-spacer />
      <v-btn 
        @click="openModal"
        color="primary"
        outlined
      >Выдать карту</v-btn>
    </v-toolbar>

    <v-card-text>
      <CardIncomeTable :items="incomeCardList"/>
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
    }
  },

  methods: {
    openModal() {
      this.$store.commit('incomeCard/openAddModal')
    }
  },

  mounted() {
    this.$store.dispatch('incomeCard/getIncomeCardList')
  }
}
</script>