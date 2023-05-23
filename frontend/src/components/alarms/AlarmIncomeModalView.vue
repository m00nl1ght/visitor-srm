<template>
  <MainModalLayoutView
    :isOpen="isOpen"
    :onClose="onClose"
    :onConfirm="onConfirm"
    :title="title"
  >
    <v-form class="pt-5" ref="form" v-model="valid" lazy-validation>
      <v-text-field
        v-model="formValue.title"
        outlined
        label="Название"
        dense
        :rules="rules"
      ></v-text-field>

      <v-text-field
        v-model="formValue.place"
        outlined
        label="Место возникновения"
        dense
        :rules="rules"
      ></v-text-field>

      <v-select
        v-model="formValue.systemAlarmListId"
        :items="systemAlarmList"
        item-text="title"
        item-value="id"
        outlined
        dense
        :rules="rules"
      ></v-select>

      <v-textarea
        v-model="formValue.comment"
        outlined
        label="Описание"
        dense
      >
      </v-textarea>
    </v-form>
  </MainModalLayoutView>
</template>

<script>
import MainModalLayoutView from '@/components/app/modals/MainModalLayoutView.vue'

export default {
  components: {
    MainModalLayoutView
  },

  data() {
    return {
      valid: true,
      rules: [
        v => !!v || 'Поле обязательно для заполнения',
      ],
    }
  },

  computed: {
    isOpen() {
      console.log('test') 
      return this.$store.state.incomeAlarm.openModal2
    },

    formValue() { 
      console.log('test') 
      return this.$store.state.incomeAlarm.formValue 
    },

    systemAlarmList() {
      console.log('test') 
      return this.$store.state.systemAlarmCategory.systemAlarmList
    },

    title() {
      console.log('test') 
      return this.$store.state.incomeAlarm.formValue.id ? 'Редактировать запись' : 'Создать запись'
    }
  },

  methods: {
    onClose() {
      console.log('test') 
      this.$store.commit('incomeAlarm/closeModal')
    },

    onConfirm() {
      console.log('test') 
      if(this.$refs.form.validate()) {
        this.$store.dispatch('incomeAlarm/registrateAlarm')
      }
    },
  },

  mounted() {
    console.log('test') 
    this.$store.dispatch('systemAlarmCategory/getSystemAlarmList')
  }
}
</script>