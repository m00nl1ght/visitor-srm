<template>
  <v-select
    label="Карта доступа"
    :value="cardId"
    :rules="nameRules"
    :items="cards"
    item-text="number"
    item-value="id"
    dense
    outlined
    no-data-text="Все карты выданны"
    @change="(value) => callback(value)"
  />
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