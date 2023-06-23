<template>
  <MainModalLayout :is-open="isOpen" :on-close="onClose" :on-confirm="onConfirm" :title="'Новое разрешение'">
    <v-form 
    ref="form" 
    v-model="valid" 
    class="pt-5" 
    lazy-validation>
      <v-autocomplete 
      :items="listName" 
      item-text="networkName" 
      label="Сетевое имя"
      >
    </v-autocomplete>
      <v-btn @click="listName">ТЕСТ</v-btn>
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
      return this.$store.getters['incomeDevice/getOpenModal']
    },

    formValue() {
      return this.$store.getters['incomeDevice/getFormValue']
    },

    listName() {
      return this.$store.state
    }

    // title() {
    //     return this.$store.state.incomeDevice.formValue.id ? 'Редактировать запись' : 'Создать запись'
    // },
  },

  mounted() {
    this.$store.dispatch('incomeDevice/getNetworkNameList')
  },

  methods: {
    onClose() {
      this.$store.commit('incomeDevice/closeModal')
    },

    onConfirm() {
      if (this.$refs.form.validate()) {
        this.$store.dispatch('incomeDevice/registrateDevice')
      }
    },
    networkNameList() {
      this.listName = this.$store.state.networkNameList
      console.log('listName', this.listName)
    }
  }
}
</script>
