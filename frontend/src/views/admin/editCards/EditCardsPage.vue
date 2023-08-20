<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Администрирование</v-toolbar-title>
      <v-spacer />
      <v-btn color="primary" outlined @click="openEditForm"> Добавить карту доступа </v-btn>
    </v-toolbar>

    <v-card-text>
      <CardTable :items="cards" @onEdit="openEditForm" />
    </v-card-text>

    <AddCardForm :editedItem="editedItem" :isOpen="isOpen" @onClose="onCloseEditForm" />
  </v-card>
</template>

<script>
import CardTable from './components/CardTable.vue'
import AddCardForm from '@/views/admin/editCards/components/AddCardForm.vue'

export default {
  components: {
    CardTable,
    AddCardForm
  },

  data() {
    return {
      editedItem: undefined,
      isOpen: false
    }
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

    openEditForm(editedItem = undefined) {
      this.editedItem = editedItem
      this.isOpen = true
    },

    onCloseEditForm() {
      this.isOpen = false
      this.editedItem = undefined
    }
  },

  mounted() {
    this.getCards()
  }
}
</script>
