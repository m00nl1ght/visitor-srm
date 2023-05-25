<template>
  <div>
    <v-row>
      <v-col cols="4">
        <v-text-field
          label="Фамилия"
          :value="data.lastName"
          @input="(value) => callback({key: 'lastName', value})"
          dense
          outlined
          :rules="nameRules"
        ></v-text-field>
      </v-col>
            
      <v-col cols="4">
        <v-text-field
          label="Имя"
          :value="data.name"
          @input="(value) => callback({key: 'name', value})"
          dense
          outlined
          :rules="nameRules"
        ></v-text-field>
      </v-col>

      <v-col cols="4">
        <v-text-field
          label="Отчество"
          :value="data.middleName"
          @input="(value) => callback({key: 'middleName', value})"
          dense
          outlined
        ></v-text-field>
      </v-col>
    </v-row>

    <v-text-field
      v-if="position"
      label="Должность"
      :value="data.position"
      @input="(value) => callback({key: 'position', value})"
      dense
      outlined
    ></v-text-field>
  </div>
</template>

<script>
export default {
  props: {
    data: Object,
    callback: Function,
    position: Boolean
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