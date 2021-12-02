<template>
  <div>
    <Person 
      :data="data"
      :callback="callback"
    />

    <v-text-field
      label="Телефон"
      :value="data.phone"
      @input="(value) => callback({key: 'phone', value})"
      outlined
      dense
    ></v-text-field>

    <v-text-field
      label="Компания/Фирма"
      :value="data.firm"
      @input="(value) => callback({key: 'firm', value})"
      outlined
      dense
    ></v-text-field>
  </div>
</template>

<script>
import Person from "@/components/app/modals/input/Person"

export default {
  props: {
    data: Object,
    callback: Function
  },

  components: {
    Person
  }
}
</script>