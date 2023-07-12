<template>
  <MainModalLayout :is-open="isOpen" :on-close="onClose" :on-confirm="onConfirm" :title="title">
    <v-form ref="form" v-model="valid" class="pt-5" lazy-validation>
      <v-autocomplete v-model="formValue.device" :items="listDeviceNetworkName" item-text="networkName" :rules="rules" label="Сетевое имя">
      </v-autocomplete>
      <v-autocomplete
        v-model="formValue.employeeId"
        :items="listEmployeeName"
        :rules="rules"
        label="ФИО сотрудника"
        item-text="lastName"
        item-value="id"
      >
        <template v-slot:selection="data">
          <span>{{ data.item.lastName }} {{ data.item.name }} {{ data.item.middleName }}</span>
        </template>
        <template v-slot:item="data">
          <span>{{ data.item.lastName }} {{ data.item.name }} {{ data.item.middleName }}</span>
        </template>
      </v-autocomplete>
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
      rules: [(v) => !!v || 'Поле обязательно для заполнения'],
    }
  },

  computed: {
    isOpen() {
      return this.$store.state.incomeDevice.openModal
    },

    formValue() {
      return this.$store.state.incomeDevice.formValue
    },

    listDeviceNetworkName() {
      return this.$store.state.incomeDevice.networkNameList
    },
    listEmployeeName() {
      return this.$store.state.incomeDevice.employeeNameList
    },

    title() {
        return this.$store.state.incomeDevice.formValue.id ? 'Редактировать запись' : 'Создать запись'
    },
  },

  mounted() {
    this.$store.dispatch('incomeDevice/getNetworkNameList')
    this.$store.dispatch('incomeDevice/getNameEmployee')
  },

  methods: {
    onClose() {
      this.$store.commit('incomeDevice/closeModal')
    },

    onConfirm() {
      if (this.$refs.form.validate() && this.formValue.id) {
        this.$store.dispatch('incomeDevice/editDevice')
        this.$store.commit('incomeDevice/closeModal')
      } else  {
        this.$store.dispatch('incomeDevice/addDevice')
        this.$store.commit('incomeDevice/closeModal')
      }
    }
  }
}
//{callback: () => this.$store.dispatch('incomeDevice/getListDeviceStatus')}
</script>
