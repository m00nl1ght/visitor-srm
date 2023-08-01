<template>
  <MainModalLayout
    :is-open="isOpen"
    :on-close="onClose"
    :on-confirm="onConfirm"
    :title="'Добавить нового посетителя'"
    :isLoading="isLoading"
  >
    <v-form
      ref="form"
      v-model="valid"
      class="pt-5"
      lazy-validation
    >
      <h2>Данные посетителя</h2>
      <v-divider class="my-2" />
      <VisitorInput
        :data="formValue.visitor"
        :callback="setVisitor"
      />

      <AutoinsertPerson
        :active="showAutoinsertVisitor"
        :items="autoinsertVisitorList"
        :on-click="autoinsertVisitor"
        :on-close="() => (showAutoinsertVisitor = false)"
      />

      <CarInput
        :data="formValue.car"
        :callback="setCar"
      />

      <CategoryInput
        :value="formValue.categoryId"
        :items="categoryList"
        :on-change="setCategory"
      />

      <h2>Данные принимающей стороны</h2>
      <v-divider class="my-2" />
      <EmployeeInput
        :data="formValue.employee"
        :callback="setEmployee"
      />

      <AutoinsertPerson
        :active="showAutoinsertEmployee"
        :items="autoinsertEmployeeList"
        :on-click="autoinsertEmployee"
        :on-close="() => (showAutoinsertEmployee = false)"
      />

      <SecurityOperatorInput
        :value="formValue.securityId"
        :items="currentGroupMembers"
        :on-change="setSecurity"
      />
    </v-form>
  </MainModalLayout>
</template>

<script>
import MainModalLayout from '@/components/app/modals/MainModalLayout.vue'
import VisitorInput from '@/components/app/modals/input/VisitorInput.vue'
import EmployeeInput from '@/components/app/modals/input/EmployeeInput.vue'
import CategoryInput from '@/components/app/modals/input/CategoryInput.vue'
import SecurityOperatorInput from '@/components/app/modals/input/SecurityOperatorInput.vue'
import CarInput from '@/components/app/modals/input/CarInput.vue'
import AutoinsertPerson from '@/components/app/autoinsert/AutoinsertPerson.vue'

export default {
  components: {
    MainModalLayout,
    VisitorInput,
    EmployeeInput,
    CategoryInput,
    SecurityOperatorInput,
    CarInput,
    AutoinsertPerson
  },

  data() {
    return {
      valid: true,
      nameRules: [(v) => !!v || 'Поле обязательно для заполнения'],
      showAutoinsertEmployee: false,
      showAutoinsertVisitor: false
    }
  },

  computed: {
    isOpen() {
      return this.$store.state.incomeCar.openModal
    },
    formValue() {
      return this.$store.state.incomeCar.formValue
    },
    currentGroupMembers() {
      return this.$store.getters['securityGroup/getCurrentGroupMembers'] || []
    },
    operator() {
      return this.$store.getters['securityGroup/getCurrentGroupOperator']
    },
    categoryList() {
      return this.$store.state.visitorCategory.categoryList
    },
    autoinsertEmployeeList() {
      return this.$store.state.autoinsert.autoinsertEmployeeList
    },
    autoinsertVisitorList() {
      return this.$store.state.autoinsert.autoinsertVisitorList
    },
    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj']('registrateNewCar')
    }
    
  },

  watch: {
    operator() {
      if (this.currentGroupMembers) {
        this.setSecurity(this.operator.id)
      }
    }
  },

  mounted() {
    this.$store.dispatch('accessCard/getCardList')
    this.$store.dispatch('visitorCategory/getCategoryList')
  },

  methods: {
    onClose() {
      this.$store.commit('incomeCar/closeModal')
    },

    async onConfirm() {
      if (this.$refs.form.validate()) {
        await this.$withLoadingIndicator(async () => await this.$store.dispatch('incomeCar/registrateNewCar'), ['registrateNewCar'])
      }
    },

    setVisitor(value) {
      this.$store.commit('incomeCar/storeFormVisitor', value)
      if (value.key == 'lastName' && value.value.length > 2) {
        this.$store.dispatch('autoinsert/getVisitorForAutoinsert', value.value)
        this.showAutoinsertVisitor = true
      }
    },
    autoinsertVisitor(value) {
      this.$store.commit('incomeCar/autoinsertVisitor', value)
      this.showAutoinsertVisitor = false
    },

    setEmployee(value) {
      this.$store.commit('incomeCar/storeFormEmployee', value)
      if (value.key == 'lastName' && value.value.length > 2) {
        this.$store.dispatch('autoinsert/getEmployeeForAutoinsert', value.value)
        this.showAutoinsertEmployee = true
      }
    },
    autoinsertEmployee(value) {
      this.$store.commit('incomeCar/autoinsertEmployee', value)
      this.showAutoinsertEmployee = false
    },

    setSecurity(value) {
      this.$store.commit('incomeCar/storeFormSecurity', value)
    },

    setCar(value) {
      this.$store.commit('incomeCar/storeFormCar', value)
    },

    setCategory(value) {
      this.$store.commit('incomeCar/storeFormCategory', value)
    }
  }
}
</script>
