<template>
  <v-data-table :headers="headers" :items="items">
    <template #[`item.printBtn`]="{ item }">
      <v-btn :disabled="disabled" @click="printCard({ id: item.id })" icon>
        <v-icon>mdi-printer</v-icon>
      </v-btn>
    </template>

    <template #[`item.visitorName`]="{ item }">
      {{ printFullName(item.visitor) }}
    </template>

    <template #[`item.inTime`]="{ item }">
      {{ $moment(item.inTime).format('HH:mm DD.MM.YYYY') }}
    </template>

    <template #[`item.actions`]="{ item }">
      <div class="d-flex align-center">
        <v-text-field
          v-if="!disabled"
          :value="exitTime[item.id] ? exitTime[item.id] : null"
          @change="value => setExitTime({ id: item.id, value })"
          type="time"
        ></v-text-field>

        <v-btn @click="exitVisitor({ id: item.id })" outlined small color="primary" class="ml-5" :disabled="disabled">
          <v-icon small class="mr-2">
            mdi-exit-run
          </v-icon>
          Вышел
        </v-btn>
      </div>
    </template>

    <template v-slot:no-data>
      <p>Данные отсутствуют...</p>
    </template>
  </v-data-table>
</template>

<script>
import peopleHelper from '@/services/helpers/people.js'
export default {
  props: {
    items: {
      type: Array,
      default: []
    },
    disabled: {
      type: Boolean,
      default: false
    }
  },

  data: () => ({
    headers: [
      {
        text: '',
        value: 'printBtn'
      },
      {
        text: 'ФИО',
        align: 'start',
        value: 'visitorName'
      },
      { text: 'Телефон', value: 'visitor.phone' },
      { text: 'Вход', value: 'inTime' },
      { text: 'Выход', value: 'actions', sortable: false }
    ],
    exitTime: {}
  }),

  methods: {
    exitVisitor({ id }) {
      this.$store.dispatch('incomeVisitor/exitVisitor', {
        id,
        time: this.exitTime[id] ? this.exitTime[id] : null
      })
    },

    setExitTime({ id, value }) {
      this.exitTime[id] = value
    },

    printCard({ id }) {
      this.$emit('printCard', { id })
    },

    printFullName(person) {
      return peopleHelper.getFullName(person)
    }
  }
}
</script>
