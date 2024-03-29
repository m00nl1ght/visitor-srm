<template>
  <MainModalLayout :is-open="isOpen" :on-close="onClose" :on-confirm="onConfirm" :title="'Добавить нового посетителя'" :isLoading="isLoading">
    <v-form ref="form" v-model="valid" class="pt-5" lazy-validation>
      <h2>Данные посетителя</h2>

      <v-divider class="my-2" />

      <VisitorInput :data="formValue.visitor" :callback="setVisitor">
        <template #autoinsert>
          <AutoinsertPerson
            :active="showAutoinsertVisitor"
            :items="autoinsertVisitorList"
            :on-click="autoinsertVisitor"
            :on-close="() => (showAutoinsertVisitor = false)"
          />
        </template>
      </VisitorInput>

      <CategoryInput :value="formValue.categoryId" :items="categoryList" :on-change="setCategory" />

      <h2>Данные принимающей стороны</h2>
      <v-divider class="my-2" />
      <EmployeeInput :data="formValue.employee" :callback="setEmployee" />
      <AutoinsertPerson
        :active="showAutoinsertEmployee"
        :items="autoinsertEmployeeList"
        :on-click="autoinsertEmployee"
        :on-close="() => (showAutoinsertEmployee = false)"
      />

      <v-select
        :value="formValue.cardId"
        :items="cardList"
        item-text="number"
        item-value="id"
        dense
        outlined
        label="Карта доступа"
        :rules="rules"
        @change="setCard"
      />

      <SecurityOperatorInput :value="formValue.securityId" :items="currentGroupMembers" :on-change="setSecurity" />
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
import { mapGetters, mapState } from 'vuex'

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
    ...mapState('incomeVisitor', {
      isOpen: 'openModal',
      formValue: 'formValue'
    }),

    ...mapState({
      categoryList: (state) => state.visitorCategory.categoryList,
      autoinsertEmployeeList: (state) => state.autoinsert.autoinsertEmployeeList,
      autoinsertVisitorList: (state) => state.autoinsert.autoinsertVisitorList
    }),

    ...mapGetters({
      currentGroupMembers: 'securityGroup/getCurrentGroupMembers',
      operator: 'securityGroup/getCurrentGroupOperator',
      cardList: 'cards/getFreeVisitorCard'
    }),

    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj']('registrateNewVisitor')
    }
  },

  methods: {
    onClose() {
      this.$store.commit('incomeVisitor/closeModal')
    },

    async onConfirm() {
      if (this.$refs.form.validate()) {
        await this.$withLoadingIndicator(async () => await this.$store.dispatch('incomeVisitor/registrateNewVisitor'), ['registrateNewVisitor'])
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
    this.$store.dispatch('cards/getCardList')
    this.$store.dispatch('visitorCategory/getCategoryList')
  }
}
</script>
