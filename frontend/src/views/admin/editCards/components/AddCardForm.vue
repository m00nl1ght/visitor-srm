<template>
  <MainModalLayout :is-open="isOpen" :on-close="onClose" :on-confirm="onConfirm" :title="title" :isLoading="isLoading">
    <v-form v-model="valid" class="pt-5" lazy-validation ref="form">
      <v-text-field v-model="formValue.number" label="Номер"></v-text-field>

      <v-select :items="categories" v-model="formValue.cardCategory" label="Категория" item-text="description" item-value="id" return-object></v-select>
    </v-form>
  </MainModalLayout>
</template>

<script>
import { mapActions } from 'vuex'
import MainModalLayout from '@/components/app/modals/MainModalLayout.vue'

export default {
  props: {
    editedItem: {
      type: Object
    },
    isOpen: {
      type: Boolean,
      default: false
    }
  },

  components: {
    MainModalLayout
  },

  data() {
    return {
      loaderObjItem: 'SAVE_ADD_CARD',
      valid: true,

      defaultFormValue: () => ({
        number: undefined,
        cardCategory: undefined
      }),

      formValue: {
        number: undefined,
        cardCategory: undefined
      }
    }
  },

  computed: {
    title() {
      return this.editedItem?.id ? 'Редактировать карту доступа' : 'Добавить карту доступа'
    },

    categories() {
      return this.$store.state.cardCategory.cardCategoryList ?? []
    },

    isLoading() {
      return this.$store.getters['appProgressBanner/loaderObj'](this.loaderObjItem)
    }
  },

  methods: {
    ...mapActions('cards', ['getCardList', 'storeCard', 'updateById']),
    ...mapActions('cardCategory', ['getCardCategoryList']),

    onClose() {
      this.$emit('onClose')
    },

    async onConfirm() {
      if (this.$refs.form.validate()) {
        if (this.formValue.id) {
          await this.$withLoadingIndicator(
            async () =>
              await this.updateById({
                data: this.formValue,
                id: this.formValue.id
              }),
            [this.loaderObjItem]
          )
        } else {
          await this.$withLoadingIndicator(async () => await this.storeCard(this.formValue), [this.loaderObjItem])
        }

        this.getCardList()
        this.onClose()
      }
    }
  },

  mounted() {
    this.getCardCategoryList()
  },

  watch: {
    isOpen(value) {
      if (value) {
        this.formValue = this.editedItem
          ? {
              ...this.defaultFormValue(),
              ...this.editedItem
            }
          : this.defaultFormValue()
      }
    }
  }
}
</script>
