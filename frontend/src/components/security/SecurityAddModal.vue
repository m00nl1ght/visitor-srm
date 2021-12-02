<template>
  <MainModalLayout
    :isOpen="isOpen"
    :onClose="onClose"
    :onConfirm="onConfirm"
    :title="title"
  >
    <v-form class="pt-5" ref="form" v-model="valid" lazy-validation>
        <v-col class="pa-0">
          <v-text-field
            v-model="lastName"
            label="Фамилия"
            outlined
            dense
            :rules="nameRules"
          ></v-text-field>
        </v-col>

        <v-col class="pa-0">
          <v-text-field
            v-model="name"
            label="Имя"
            outlined
            dense
            :rules="nameRules"
          ></v-text-field>
        </v-col>

        <v-col class="pa-0">
          <v-text-field
            v-model="middleName"
            label="Отчество"
            outlined
            dense
            :value="addFormValue.middle_name"
          ></v-text-field>
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
          >
          </v-select>
        </v-col>
    </v-form>
  </MainModalLayout>
</template>

<script>
import MainModalLayout from '@/components/app/modals/MainModalLayout.vue'

export default {
  props: {
    title: String
  },

  components: {
    MainModalLayout
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
    }
  },

  methods: {
    onClose() {
      this.$store.commit('security/setSecurityModalOpen', false)
    },

    onConfirm() {
      if(this.$refs.form.validate()) {
        this.$store.dispatch('security/addSecurity')
      }
    },

    setAddFormValue(value, key) {
      this.$store.commit('security/setAddFormValue', {value, key})
    }
  }
}
</script>