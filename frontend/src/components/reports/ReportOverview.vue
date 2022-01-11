<template>
  <v-container>
    <v-overlay :value="overlay">
      <v-progress-circular indeterminate size="64" color="primary"></v-progress-circular>
    </v-overlay>

    <v-row align="center">
      <v-col cols="12" sm="6" md="4">
        <v-menu v-model="menu" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
          <template v-slot:activator="{ on, attrs }">
            <v-text-field v-model="date" label="Выберите даты" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"></v-text-field>
          </template>
          <v-date-picker v-model="date" range color="primary" locale="ru-ru"></v-date-picker>
        </v-menu>
      </v-col>

      <v-col>
        <v-btn :disabled="!date" color="primary" outlined @click="getReport">Показать отчет</v-btn>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <h2 class="mb-3">Отчет за следующие даты: {{ dateTitle ? dateTitle : '' }}</h2>
        <SecurityMainReport :reportData="reportData" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import SecurityMainReport from '@/components/reports/SecurityMainReport.vue'

export default {
  props: {
    reportData: {
      type: Object,
      default: () => {}
    }
  },

  components: {
    SecurityMainReport
  },

  data() {
    return {
      menu: false,
      date: undefined,
      overlay: false,
      dateTitle: undefined
    }
  },

  methods: {
    getReport() {
      this.overlay = true

      if (this.date.length === 1 || this.date[0] == this.date[1]) {
        this.$emit('getReportByDay', this.date[0], () => (this.overlay = false))
        this.dateTitle = this.$moment(this.date[0]).format('DD.MM.YYYY')
      } else {
        const requestDate = {}
        if (this.date[0] > this.date[1]) {
          requestDate.start = this.date[1]
          requestDate.end = this.date[0]
        } else {
          requestDate.start = this.date[0]
          requestDate.end = this.date[1]
        }

        this.$emit('getReportByDuration', requestDate, () => (this.overlay = false))
        this.dateTitle = `${this.$moment(requestDate.start).format('DD.MM.YYYY')} - ${this.$moment(requestDate.end).format('DD.MM.YYYY')}`
      }
    }
  }
}
</script>
