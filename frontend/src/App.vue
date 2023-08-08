<template>
  <component :is="layout" />
</template>

<script>
import EmptyLayout from '@/layouts/EmptyLayout.vue'
import MainLayout from '@/layouts/MainLayout.vue'

export default {
  name: 'App',
  components: {
    EmptyLayout, MainLayout
  },
  data: () => ({
    //
  }),
  computed: {
    layout() {
      return (this.$route.meta.layout || 'empty') + '-layout'
    }
  }
};
</script>
