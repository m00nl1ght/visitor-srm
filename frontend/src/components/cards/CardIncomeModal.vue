<template>
  <MainModalLayout :isOpen="isOpen" :onClose="onClose" :onConfirm="onConfirm" :title="'Выдать карту'">
    <v-alert v-if="cards.length == 0" class="mt-5" border="left" outlined type="warning"> Не осталось свободных карт доступа </v-alert>

    <v-form v-else class="pt-5" ref="form" v-model="valid" lazy-validation>
      <h2>Данные сотрудника</h2>
      <v-divider class="my-2" />

      <PersonInput :data="formValue.employee" :callback="setEmployeeFormValue" />
      <v-text-field
        :value="formValue.employee.position"
        @input="(value) => setEmployeeFormValue({ key: 'position', value })"
        outlined
        dense
        label="Должность"
      ></v-text-field>

      <AutoinsertPerson
        :active="showAutoinsertEmployee"
        :items="autoinsertList"
        :onClick="autoinsertEmployee"
        :onClose="() => (showAutoinsertEmployee = false)"
      />

      <CardInput :cardId="formValue.cardId" :callback="setCardIdFormValue" :cards="cards" />

      <h2>Данные руководителя сотрудника</h2>
      <v-divider class="my-2" />

      <PersonInput :data="formValue.boss" :callback="setBossFormValue" />
      <v-text-field
        :value="formValue.boss.position"
        @input="(value) => setBossFormValue({ key: 'position', value })"
        outlined
        dense
        label="Должность"
      ></v-text-field>

      <AutoinsertPerson
        :active="showAutoinsertBoss"
        :items="autoinsertList"
        :onClick="autoinsertBoss"
        :onClose="() => (showAutoinsertBoss = false)"
      />
    </v-form>
  </MainModalLayout>
</template>

<script>
import PersonInput from '@/components/app/modals/input/PersonInput.vue'
import CardInput from '@/components/app/modals/input/CardInput.vue'
import MainModalLayout from '@/components/app/modals/MainModalLayout.vue'
import AutoinsertPerson from '@/components/app/autoinsert/AutoinsertPerson.vue'

export default {
  components: {
    PersonInput,
    CardInput,
    MainModalLayout,
    AutoinsertPerson
  },

  data() {
    return {
      valid: true,
      nameRules: [(v) => !!v || 'Поле обязательно для заполнения'],

      showAutoinsertEmployee: false,
      showAutoinsertBoss: false
    }
  },

  computed: {
    formValue() {
      return this.$store.state.incomeCard.formValue
    },

    isOpen() {
      return this.$store.state.incomeCard.openModal
    },

    cards() {
      return this.$store.getters['accessCard/getFreeEmployeeCard']
    },

    autoinsertList() {
      return this.$store.state.autoinsert.autoinsertEmployeeList
    }
  },

  methods: {
    onClose() {
      this.$store.commit('incomeCard/closeModal')
    },

    onConfirm() {
      if (this.$refs.form.validate()) {
        this.$store.dispatch('incomeCard/addIncomeCard')
      }
    },

    closeAutoinsertField() {
      this.showAutoinsertEmployee = false
      this.showAutoinsertBoss = false
      this.$store.commit('incomeCard/setClearAutoinsert')
    },

    setEmployeeFormValue(value) {
      this.$store.commit('incomeCard/setEmployeeFormValue', value)
      if (value.key == 'lastName' && value.value.length > 2) {
        this.$store.dispatch('autoinsert/getEmployeeForAutoinsert', value.value)
        this.showAutoinsertEmployee = true
      }
    },

    setBossFormValue(value) {
      this.$store.commit('incomeCard/setBossFormValue', value)
      if (value.key == 'lastName' && value.value.length > 2) {
        this.$store.dispatch('autoinsert/getEmployeeForAutoinsert', value.value)
        this.showAutoinsertBoss = true
      }
    },

    setCardIdFormValue(value) {
      this.$store.commit('incomeCard/setCardIdFormValue', value)
    },

    autoinsertEmployee(value) {
      this.$store.commit('incomeCard/setAutoinsertEmployee', value)
      this.closeAutoinsertField()
    },

    autoinsertBoss(value) {
      this.$store.commit('incomeCard/setAutoinsertBoss', value)
      this.closeAutoinsertField()
    }
  },

  mounted() {
    this.$store.dispatch('accessCard/getCardList')
  }
}
</script>
