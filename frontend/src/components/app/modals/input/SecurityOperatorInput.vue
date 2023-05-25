<template>
  <v-select
    :value="value"
    :items="items"
    item-text="lastName"
    item-value="id"
    dense
    outlined
    label="Оператор охраны"
    :rules="nameRules"
    @change="onChange"
  >
    <template #selection="{ item }">
      <span>{{ `${item.lastName} ${item.name}` }}</span>
    </template>

    <template #item="{ item }">
      {{ `${item.lastName} ${item.name}` }}
    </template>
  </v-select>
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