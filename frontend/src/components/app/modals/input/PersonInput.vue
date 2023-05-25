<template>
    <v-row>
      <v-col cols="4">
        <v-text-field
          label="Фамилия"
          :value="data.lastName"
          @input="(value) => callback({key: 'lastName', value})"
          :rules="nameRules"
          outlined
          dense
        ></v-text-field>
      </v-col>

      <v-col cols="4">
        <v-text-field
          label="Имя"
          :value="data.name"
          @input="(value) => callback({key: 'name', value})"
          :rules="nameRules"
          outlined
          dense
        ></v-text-field>
      </v-col>

      <v-col cols="4">
        <v-text-field
          label="Отчество"
          :value="data.middleName"
          @input="(value) => callback({key: 'middleName', value})"
          outlined
          dense
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
      nameRules: [
        v => !!v || 'Поле обязательно для заполнения',
      ],
    }
  }
}
</script>