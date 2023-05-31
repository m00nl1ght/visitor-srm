<template>
  <v-row>
    <v-col cols="4">
      <v-text-field
        label="Фамилия"
        :value="data.lastName"
        :rules="nameRules"
        outlined
        dense
        @input="(value) => callback({key: 'lastName', value})"
      />
    </v-col>

    <v-col cols="4">
      <v-text-field
        label="Имя"
        :value="data.name"
        :rules="nameRules"
        outlined
        dense
        @input="(value) => callback({key: 'name', value})"
      />
    </v-col>

    <v-col cols="4">
      <v-text-field
        label="Отчество"
        :value="data.middleName"
        outlined
        dense
        @input="(value) => callback({key: 'middleName', value})"
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
      nameRules: [
        v => !!v || 'Поле обязательно для заполнения',
      ],
    }
  }
}
</script>