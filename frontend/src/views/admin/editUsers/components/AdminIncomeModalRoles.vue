<template>
  <MainModalLayout :is-open="isOpen" :on-close="onClose" :on-confirm="onConfirm" :title="title" :isLoading="isLoading">
    <v-form ref="form" v-model="valid" class="pt-5" lazy-validation>
      <v-autocomplete
        v-model="roles"
        :items="showRolesList"
        item-text="title"
        outlined
        dense
        chips
        small-chips
        label="Роль"
        multiple
        deletable-chips
        return-object
      >
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
      valid: true
    }
  },

  computed: {
    isOpen() {
      return this.$store.state.user.openModalRoles
    },
    showRolesList() {
      return this.$store.state.user.rolesList
    },
    roles: {
      get() {
        return this.$store.state.user.roles
      },
      set(newValue) {
        this.$store.commit('user/currentUserRoles', newValue)
      }
    },
    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj']('addRoles')
    }
  },

  methods: {
    onClose() {
      this.$store.commit('user/closeModalRoles')
    },
    async onConfirm() {
      await this.$withLoadingIndicator(async () => await this.$store.dispatch('user/addRoles'), ['addRoles'])
    }
  },

  mounted() {
    this.$store.dispatch('user/getRolesList')
  }
}
</script>
