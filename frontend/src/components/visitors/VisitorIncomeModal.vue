<template>
  <MainModalLayout :isOpen="isOpen" :onClose="onClose" :onConfirm="onConfirm" :title="'Добавить нового посетителя'">
    <v-form class="pt-5" ref="form" v-model="valid" lazy-validation>
      <h2>Данные посетителя</h2>
      <v-divider class="my-2" />
      <VisitorInput :data="formValue.visitor" :callback="setVisitor" />
      <AutoinsertPerson
        :active="showAutoinsertVisitor"
        :items="autoinsertVisitorList"
        :onClick="autoinsertVisitor"
        :onClose="() => (showAutoinsertVisitor = false)"
      />
      <CategoryInput :value="formValue.categoryId" :items="categoryList" :onChange="setCategory" />

      <h2>Данные принимающей стороны</h2>
      <v-divider class="my-2" />
      <EmployeeInput :data="formValue.employee" :callback="setEmployee" />
      <AutoinsertPerson
        :active="showAutoinsertEmployee"
        :items="autoinsertEmployeeList"
        :onClick="autoinsertEmployee"
        :onClose="() => (showAutoinsertEmployee = false)"
      />

      <v-select
        :value="formValue.cardId"
        :items="cardList"
        item-text="number"
        item-value="id"
        @change="setCard"
        dense
        outlined
        label="Карта доступа"
        :rules="rules"
      >
      </v-select>

      <SecurityOperatorInput :value="formValue.securityId" :items="currentGroupMembers" :onChange="setSecurity" />
    </v-form>
  </MainModalLayout>
</template>

<script>
import MainModalLayout from '@/components/app/modals/MainModalLayout.vue'
import VisitorInput from '@/components/app/modals/input/VisitorInput.vue'
import EmployeeInput from '@/components/app/modals/input/EmployeeInput.vue'
import CategoryInput from '@/components/app/modals/input/CategoryInput.vue'
import SecurityOperatorInput from '@/components/app/modals/input/SecurityOperatorInput.vue'
import AutoinsertPerson from '@/components/app/autoinsert/AutoinsertPerson.vue'

export default {
  components: {
    MainModalLayout,
    VisitorInput,
    EmployeeInput,
    CategoryInput,
    SecurityOperatorInput,
    AutoinsertPerson
  },

  data() {
    return {
      valid: true,
      rules: [(v) => !!v || 'Поле обязательно для заполнения'],
      showAutoinsertEmployee: false,
      showAutoinsertVisitor: false
    }
  },

  computed: {
    isOpen() {
      return this.$store.getters['incomeVisitor/getOpenModal']
    },
    formValue() {
      return this.$store.getters['incomeVisitor/getFormValue']
    },
    currentGroupMembers() {
      return this.$store.getters['securityGroup/getCurrentGroupMembers'] || []
    },
    operator() {
      return this.$store.getters['securityGroup/getCurrentGroupOperator']
    },
    cardList() {
      return this.$store.getters['accessCard/getFreeVisitorCard']
    },
    categoryList() {
      return this.$store.state.visitorCategory.categoryList
    },
    autoinsertEmployeeList() {
      return this.$store.state.autoinsert.autoinsertEmployeeList
    },
    autoinsertVisitorList() {
      return this.$store.state.autoinsert.autoinsertVisitorList
    }
  },

  methods: {
    onClose() {
      this.$store.commit('incomeVisitor/closeModal')
    },

    onConfirm() {
      if (this.$refs.form.validate()) {
        this.$store.dispatch('incomeVisitor/registrateNewVisitor')
      }
    },

    setVisitor(value) {
      this.$store.commit('incomeVisitor/storeFormVisitor', value)
      if (value.key == 'lastName' && value.value.length > 2) {
        this.$store.dispatch('autoinsert/getVisitorForAutoinsert', value.value)
        this.showAutoinsertVisitor = true
      }
    },

    autoinsertVisitor(value) {
      this.$store.commit('incomeVisitor/autoinsertVisitor', value)
      this.showAutoinsertVisitor = false
    },

    setEmployee(value) {
      this.$store.commit('incomeVisitor/storeFormEmployee', value)
      if (value.key == 'lastName' && value.value.length > 2) {
        this.$store.dispatch('autoinsert/getEmployeeForAutoinsert', value.value)
        this.showAutoinsertEmployee = true
      }
    },

    autoinsertEmployee(value) {
      this.$store.commit('incomeVisitor/autoinsertEmployee', value)
      this.showAutoinsertEmployee = false
    },

    setSecurity(value) {
      this.$store.commit('incomeVisitor/storeFormSecurity', value)
    },

    setCard(value) {
      this.$store.commit('incomeVisitor/storeFormCard', value)
    },

    setCategory(value) {
      this.$store.commit('incomeVisitor/storeFormCategory', value)
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
  }
}
</script>
