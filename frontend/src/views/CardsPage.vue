<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список выданых карт</v-toolbar-title>
      <v-spacer />
      <v-btn v-if="hasAccessRole(securityGroup)" color="primary" outlined @click="openModal"> Выдать карту </v-btn>
    </v-toolbar>

    <v-card-text>
      <CardIncomeTable :items="incomeCardList" :isLoading="isLoading" />
    </v-card-text>

    <CardIncomeModal />
  </v-card>
</template>

<script>
import CardIncomeTable from '@/components/cards/CardIncomeTable.vue'
import CardIncomeModal from '@/components/cards/CardIncomeModal.vue'

export default {
  components: {
    CardIncomeTable,
    CardIncomeModal
  },

  data: () => ({
    securityGroup: ['admin', 'security', 'security_chief', 'employee_security_chief'],
  }),

  computed: {
    incomeCardList() {
      return this.$store.state.incomeCard.incomeCardList
    },

    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj']('getIncomeCardList')
    },

    hasAccessRole() {
      return this.$store.getters['user/hasAccessRole']
    }
  },

  methods: {
    openModal() {
      this.$store.commit('incomeCard/openAddModal')
    }
  },

  async mounted() {
    if (this.incomeCardList && this.incomeCardList == 0) {
      await this.$withLoadingIndicator(async () => await this.$store.dispatch('incomeCard/getIncomeCardList'), ['getIncomeCardList'])
    }
  }
}
</script>
