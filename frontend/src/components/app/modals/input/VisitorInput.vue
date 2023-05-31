<template>
  <div>
    <PersonInput
      :data="data"
      :callback="callback"
    />

    <v-text-field
      label="Телефон"
      :value="data.phone"
      outlined
      dense
      @input="(value) => callback({ key: 'phone', value })"
    />

    <v-text-field
      label="Компания/Фирма"
      :value="data.firm"
      outlined
      dense
      @input="(value) => callback({ key: 'firm', value })"
    />
  </div>
</template>

<script>
import PersonInput from '@/components/app/modals/input/PersonInput.vue'

export default {

  components: {
    PersonInput
  },
  props: {
    data: Object,
    callback: Function
  }
}
</script>
