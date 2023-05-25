<template>
  <div>
    <v-row>
      <v-col cols="4">
        <v-text-field
          label="Фамилия"
          :value="data.lastName"
          dense
          outlined
          :rules="nameRules"
          @input="(value) => callback({key: 'lastName', value})"
        />
      </v-col>
            
      <v-col cols="4">
        <v-text-field
          label="Имя"
          :value="data.name"
          dense
          outlined
          :rules="nameRules"
          @input="(value) => callback({key: 'name', value})"
        />
      </v-col>

      <v-col cols="4">
        <v-text-field
          label="Отчество"
          :value="data.middleName"
          dense
          outlined
          @input="(value) => callback({key: 'middleName', value})"
        />
      </v-col>
    </v-row>

    <v-text-field
      v-if="position"
      label="Должность"
      :value="data.position"
      dense
      outlined
      @input="(value) => callback({key: 'position', value})"
    />
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