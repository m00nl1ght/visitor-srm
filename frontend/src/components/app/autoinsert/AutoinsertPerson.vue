<template>
  <v-card
    v-if="active && items.length !== 0"
    class="mb-2"
  >
    <v-card-title>
      <h5>Выберите для автоподстановки</h5>
      <v-spacer />
      <v-btn
        icon
        @click="onClose"
      >
        <v-icon>mdi-close</v-icon>
      </v-btn>
    </v-card-title>

    <v-card-text>
      <v-list
        dense
        class="py-0"
      >
        <v-list-item
          v-for="item in items"
          :key="item.id"
          dense
          @click="onClick(item)"
        >
          {{ autoinsertText(item) }}
        </v-list-item>
      </v-list>
    </v-card-text>
  </v-card>
</template>

<script>
import peopleHelper from '@/services/helpers/people.js'

export default {
  props: {
    items: {
      type: Array,
      default: () => []
    },
    active: {
      type: Boolean,
      default: false
    },

    onClick: Function,
    onClose: {
      type: Function,
      default: () => {}
    }
  },

  methods: {
    autoinsertText(value) {
      let str = ''
      if (value.lastName && value.name) str = peopleHelper.getShortName(value)
      else if (value.position && typeof value.position == 'string') str = value.position

      return str
    }
  }
}
</script>
