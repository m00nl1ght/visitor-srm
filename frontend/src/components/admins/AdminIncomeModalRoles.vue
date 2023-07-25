<template>
  <MainModalLayout :is-open="isOpen" :on-close="onClose" :on-confirm="onConfirm" :title="title">
    <v-form ref="form" v-model="valid" class="pt-5" lazy-validation>
      <v-autocomplete v-model="formRoles.role.id" :items="showRolesList" item-text="title" outlined dense chips small-chips label="Роль" multiple deletable-chips>
      
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
      title: 'Добавить роль',
      valid: true,
      currentRole: [],
    }
  },

  computed: {
    isOpen() {
      return this.$store.state.user.openModalRoles
    },
    showRolesList() {
      return this.$store.state.user.rolesList
    },
    formRoles() {
      return this.$store.state.user.formRoles
    }
  },

  methods: {
    onClose() {
      this.$store.commit('user/closeModalRoles')
    },
    onConfirm() {}
  },

  mounted() {
    this.$store.dispatch('user/getRolesList')
  }
}
</script>
