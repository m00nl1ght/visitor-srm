<template>
  <MainModalLayout
    :is-open="isOpen"
    :on-close="onClose"
    :on-confirm="onConfirm"
    :title="title"
    :isLoading="isLoading"
  >
    <v-form
      ref="form"
      v-model="valid"
      class="pt-5"
      lazy-validation
    >
      <v-col class="pa-0">
        <v-text-field
          v-model="lastName"
          label="Фамилия"
          outlined
          dense
          :rules="nameRules"
        />
      </v-col>

      <v-col class="pa-0">
        <v-text-field
          v-model="name"
          label="Имя"
          outlined
          dense
          :rules="nameRules"
        />
      </v-col>

      <v-col class="pa-0">
        <v-text-field
          v-model="middleName"
          label="Отчество"
          outlined
          dense
          :value="addFormValue.middle_name"
        />
      </v-col>

      <v-col class="pa-0">
        <v-select
          v-model="role"
          label="Должность"
          outlined
          dense
          :items="securityRoles"
          item-text="title"
          item-value="id"
        />
      </v-col>
    </v-form>
  </MainModalLayout>
</template>

<script>
import MainModalLayout from '@/components/app/modals/MainModalLayout.vue'

export default {

  components: {
    MainModalLayout
  },
  props: {
    title: String
  },

  data() {
    return {
      valid: true,
      nameRules: [
        v => !!v || 'Поле обязательно для заполнения',
      ],
    }
  },  

  computed: {
    addFormValue() { return this.$store.getters['security/addFormValue']},
    isOpen() { return this.$store.getters['security/securityModalOpen'] },
    securityRoles() { return this.$store.getters['security/securityRoles']},

    name: {
      get() { return this.addFormValue.name },
      set(val) { this.setAddFormValue(val, 'name') }
    },

    lastName: {
      get() { return this.addFormValue.lastName },
      set(val) { this.setAddFormValue(val, 'lastName') }
    },

    middleName: {
      get() { return this.addFormValue.middleName },
      set(val) { this.setAddFormValue(val, 'middleName') }
    },

    role: {
      get(){
        return this.addFormValue.roleSecurityId
      },
      set(value) {
        this.setAddFormValue(value, 'roleSecurityId')
      }
    },

    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj']('addSecurity')
    }
  },

  methods: {
    onClose() {
      this.$store.commit('security/setSecurityModalOpen', false)
    },

    async onConfirm() {
      if(this.$refs.form.validate()) {
        await this.$withLoadingIndicator(async () => await this.$store.dispatch('security/addSecurity'), ['addSecurity'])
      }
    },

    setAddFormValue(value, key) {
      this.$store.commit('security/setAddFormValue', {value, key})
    }
  }
}
</script>