<template>
  <MainModalLayout
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
  </MainModalLayout>
</template>

<script>
import MainModalLayout from '@/components/app/modals/MainModalLayout.vue'

export default {
  components: {
    MainModalLayout
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
      return this.$store.state.incomeAlarm.openModal
    },

    formValue() { 
      return this.$store.state.incomeAlarm.formValue 
    },

    systemAlarmList() {
      return this.$store.state.systemAlarmCategory.systemAlarmList
    },

    title() {
      return this.$store.state.incomeAlarm.formValue.id ? 'Редактировать запись' : 'Создать запись'
    }
  },

  methods: {
    onClose() {
      this.$store.commit('incomeAlarm/closeModal')
    },

    onConfirm() {
      if(this.$refs.form.validate()) {
        this.$store.dispatch('incomeAlarm/registrateAlarm')
      }
    },
  },

  mounted() {
    this.$store.dispatch('systemAlarmCategory/getSystemAlarmList')
  }
}
</script>