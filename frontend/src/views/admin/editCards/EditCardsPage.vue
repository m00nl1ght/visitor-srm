<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Администрирование</v-toolbar-title>
      <v-spacer />
      <v-btn color="primary" outlined @click="onAdd"> Добавить карту доступа </v-btn>
    </v-toolbar>

    <v-card-text>
      <CardTable :items="cards" />
    </v-card-text>
  </v-card>
</template>

<script>
import CardTable from './components/CardTable.vue'

export default {
  components: {
    CardTable
  },

  data() {
    return {}
  },

  computed: {
    cards() {
      return this.$store.state.cards.cardList
    }
  },

  methods: {
    getCards() {
      this.$store.dispatch('cards/getCardList')
    },

    onAdd() {
      console.log('onAdd')
    }
  },

  mounted() {
    this.getCards()
  }
}
</script>
