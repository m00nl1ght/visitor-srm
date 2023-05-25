<template>
  <div>
    <PersonInput :data="data" :callback="callback" />

    <v-text-field label="Телефон" :value="data.phone" @input="(value) => callback({ key: 'phone', value })" outlined dense></v-text-field>

    <v-text-field label="Компания/Фирма" :value="data.firm" @input="(value) => callback({ key: 'firm', value })" outlined dense></v-text-field>
  </div>
</template>

<script>
import PersonInput from '@/components/app/modals/input/PersonInput.vue'

export default {
  props: {
    data: Object,
    callback: Function
  },

  components: {
    PersonInput
  }
}
</script>
