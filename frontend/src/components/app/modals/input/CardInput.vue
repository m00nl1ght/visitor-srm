<template>
  <v-select
    label="Карта доступа"
    :value="cardId"
    @change="(value) => callback(value)"
    :rules="nameRules"
    :items="cards"
    item-text="number"
    item-value="id"
    dense
    outlined
    no-data-text="Все карты выданны"
  >
  </v-select>
</template>

<script>
export default {
  props: {
    cardId: [String, Number],
    cards: Array,
    callback: Function
  },

  data() {
    return {
      nameRules: [
        v => !!v || 'Поле обязательно для заполнения',
      ],
    }
  }
}
</script>