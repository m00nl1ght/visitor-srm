<template>
  <v-select
    :value="value"
    :items="items"
    item-text="title"
    item-value="id"
    dense
    outlined
    label="Категория посетителя"
    :rules="nameRules"
    @change="onChange"
  />
</template>

<script>
export default {
  props: {
    value: [String, Number],
    items: Array,
    onChange: Function
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