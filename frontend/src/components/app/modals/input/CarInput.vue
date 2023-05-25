<template>
  <v-row>
    <v-col cols="6">
      <v-text-field
        label="Модель автомобиля"
        :value="data.model"
        @input="(value) => callback({key: 'model', value})"
        dense
        outlined
        :rules="rules"
      ></v-text-field>
    </v-col>
          
    <v-col cols="6">
      <v-text-field
        label="Номер автомобиля"
        :value="data.number"
        @input="(value) => callback({key: 'number', value})"
        dense
        outlined
        :rules="rules"
      ></v-text-field>
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