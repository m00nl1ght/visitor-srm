<template>
  <v-row>
    <v-col cols="6">
      <v-text-field
        label="Модель автомобиля"
        :value="data.model"
        dense
        outlined
        :rules="rules"
        @input="(value) => callback({key: 'model', value})"
      />
    </v-col>
          
    <v-col cols="6">
      <v-text-field
        label="Номер автомобиля"
        :value="data.number"
        dense
        outlined
        :rules="rules"
        @input="(value) => callback({key: 'number', value})"
      />
    </v-col>
  </v-row>
</template>

<script>
export default {
  props: {
    data: Object,
    callback: Function
  },

  data() {
    return {
      rules: [
        v => !!v || 'Поле обязательно для заполнения',
      ],
    }
  }
}
</script>